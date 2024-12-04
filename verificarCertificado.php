<?php
//error_reporting(0);




if(!isset($_GET["t"]) || $_GET["t"] == ""){
   header("Location: index.php?erro");
}else{	



    include_once("dao/clsConexao.php");
 
	$token = $_GET["t"];

	require('fpdf/fpdf.php');
	
	define ('FPDF_FONTPATH','fpdf/font/');
	
	$pdf= new FPDF("L","mm","A4");
	
	$pdf->SetFont('arial','',10);
	
	$pdf->SetY("-1");
	
	$pdf->Cell(0,0,'',0,1,'L'); 
	
	$gerar = 0;

    $query = "select i.id AS idInscrito, i.nome, i.matricula, i.instrutor, e.hours AS horas, e.name AS evento, 
                DATE_FORMAT( e.date , '%d') AS dia, 
                DATE_FORMAT( e.date , '%m') AS mes,
                DATE_FORMAT( e.date , '%Y') AS ano , i.token
                FROM inscritos_fadergs i
                INNER JOIN event e ON e.id = i.evento_id
                WHERE i.token = '".$token."' ";

          //      echo $query;

    $resultAtividade =  Conexao::consultar($query);
		
    if ( mysqli_num_rows( $resultAtividade ) == 0){
        header("Location: index.php?certificadoNaoEncontrado");
    }else{


        $gerar = 1;
        $dados = mysqli_fetch_assoc( $resultAtividade );

        if( $dados["horas"] == 0 ){
            $gerar = 0;
        }
    }

	
	
	
	
	
	
	

	if(!$gerar)
	{


        
		$pdf->SetY("25");
		$pdf->SetX("10");

		//escreve no pdf largura,altura,conteudo,borda,quebra de linha,alinhamento
		$pdf->SetFont('courier','B',35);
	//	$pdf->Cell(75,50,utf8_decode('Certificado Indisponível, não encontramos'),0,0,'C');
        $pdf->MultiCell(250,10,utf8_decode('Certificado Indisponível, não encontramos seu endereço de e-mail em nossos registros: '.$email),2,'C');
	
	}
	

	if($gerar)
	{

		$participacao = "participação";
        $horas = $dados["horas"];
        if( $dados["instrutor"] == 1 ){
            $participacao = "palestrante";
            $horas *= 2;
        }
        if( $dados["instrutor"] == 2 ){
            $participacao = "organizador(a)";
            $horas *= 2;
        }
        
        if( $dados["instrutor"] == 3 ){
            $participacao = "avaliador(a)";
            $horas *= 2;
        }
        if( $dados["instrutor"] == 4 ){
            $participacao = "coordenador(a)";
            $horas *= 2;
        }

	

		
		$pdf->Image("img/fundo.png", 0,0,297,210);
		

        
         //definindo o nome do participante
        $nome = $dados["nome"];
        //$nome = utf8_decode($nome);
        $nome = strtoupper($nome);
            
        $pdf->SetY("50");
        $pdf->SetX("25");
        $titulo = utf8_decode( "\t\t\t\t\tO Centro Universitário Fadergs confere certificado de $participacao no evento: " );
        $pdf->SetFont('courier','',18);
        $pdf->MultiCell(247,10,$titulo,0,'J');



        $pdf->SetY("70");
        $pdf->SetX("25");
        $oficina = utf8_decode(  $dados["evento"] );
        
        $pdf->SetFont('courier','B',20);
        $pdf->MultiCell(247,10,$oficina,0,'C');
        
        $pdf->SetY("90");
        $pdf->SetX("25");
        $pdf->SetFont('courier','',18);
        $pdf->MultiCell(247,10, utf8_decode("à"),0,'C');

        $pdf->SetY("100");
        $pdf->SetX("25");
        $pdf->SetFont('courier','B',20);
        $pdf->MultiCell(247,10, utf8_decode($nome),0,'C');


        $meses = [ "" , "janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro"];
        
        $mes = (int) $dados["mes"];

        $data = $dados["dia"]." de ".$meses[$mes]." de ".$dados["ano"];

        $pdf->SetY("125");
        $pdf->SetX("25");
        $texto_hora = "hora";
        if( $horas > 1) $texto_hora = "horas";

        $titulo2 = utf8_decode( "\t\t\t\t\tO evento foi realizado no dia $data, totalizando ".$horas." ".$texto_hora." de atividades." );
        $pdf->SetFont('courier','',18);
        $pdf->MultiCell(247,10,$titulo2,0,'J');
        
        

        $pdf->SetY("150");
        $pdf->SetX("75");
        $pdf->SetFont('courier','',18);
        $pdf->MultiCell(197,10,utf8_decode( "Porto Alegre, $data."  ),0,'R');
        



        $matricula = $dados["matricula"];
        if( $matricula && $matricula != "" && $matricula != " " && $matricula != " "){
            
            $pdf->SetY("150");
            $pdf->SetX("25");
            $pdf->SetFont('courier','B',12);
            $pdf->MultiCell(150,10,utf8_decode( "Matrícula / RA: ".$matricula ),2,'L');
                
        }

        //    $pdf->SetY("170");
        //    $pdf->SetX("25");
        //   $pdf->Image("logo_checkin.jpeg",25,160,NULL,35);
           
           $pdf->Image("img/assinatura_lisandro.png",172,167,NULL,24);
          
           // Linha da Assinatura
           $pdf->SetY("182");
           $pdf->SetX("170");  
           $pdf->Cell(80,0,'',1,1,'L'); 
          
          $pdf->SetFont('arial','B','16');
          $pdf->SetY("184");
          $pdf->SetX("170"); 
         $pdf->Cell(80,3,'Lisandro Martins da Silva',0,0,'C');
          
           $pdf->SetFont('arial','','10');
           $pdf->SetY("189.9");
           $pdf->SetX("170");  
           $pdf->Cell(80,0,utf8_decode('Gerente FADERGS'),0,0,'C'); 


            $pdf->AddPage();

            $pdf->SetFont('arial','','12');
            $pdf->SetY("25");
            $pdf->SetX("25");
            //$URL_ATUAL= "http://".$_SERVER['HTTP_HOST']."/oficinas/certificado/verificarCertificado.php?t=".$token;

         

            $URL_ATUAL= "http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'] ."?t=".$token;
   
        
            $pdf->MultiCell(270,10,utf8_decode( "A validade deste certificado pode ser verificada no seguinte endereço:\n".$URL_ATUAL) ,0,'L');


            // $qr = "qr_img0.50j/php/qr_img.php?";
            // $qr .= "d=".$URL_ATUAL."&e=H&s=10&t=P";
        
            // $pdf->SetY("100");
            // $pdf->SetX("25");
            // $pdf->Image( $qr ,100,100,NULL,100);


		
	}
	//imprime a saida do arquivo..

	$pdf->Output("certificado.pdf","I");

}


?>