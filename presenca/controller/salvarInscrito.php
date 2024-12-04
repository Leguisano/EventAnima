<?php

$agora = date("Y-m-d H-i-s");


include_once('clsConexao.php');
$idAtividade = $_GET["a"];
$token = $_GET["t"];

$nome = $_POST["nome"];
$email = $_POST["email"];

$query = "SELECT id FROM inscritos_fadergs WHERE email = '".$_POST["email"]."' AND evento_id = $idAtividade ";
$consulta = Conexao::consultar($query);

if( mysqli_num_rows($consulta) == 0 ){



	$query = "INSERT INTO inscritos_fadergs (nome, email, matricula, evento_id, instrutor, cpf, nascimento, cidade, estado, sexo, nota) VALUES 
    	        (   '".$nome."' , 
    	            '".$email."' , 
    	            '".$_POST["ra"]."' , 
    	             ".$idAtividade." ,
    	            0, 
    	            '".$_POST["cpf"]."',  
    	            '".$_POST["nasc"]."', 
    	            '".$_POST["cidade"]."', 
    	            '".$_POST["estado"]."', 
    	            '".$_POST["sexo"]."' ,
		                ".$_POST["nota"]."
    	            );";

	  $id =  Conexao::executarComRetornoId( $query );
}else{
	
	$dados2 = mysqli_fetch_assoc($consulta);
	$id = $dados2['id'];
	$query = "UPDATE inscritos_fadergs SET  
                    nome = '".$nome."' , 
            	    email = '".$email."' , 
            	    matricula = '".$_POST["ra"]."' ,
            	    cpf = '".$_POST["cpf"]."' , 
            	    nascimento = '".$_POST["nasc"]."' , 
            	    cidade = '".$_POST["cidade"]."' , 
            	    estado = '".$_POST["estado"]."' , 
            	    sexo = '".$_POST["sexo"]."' , 
            	    nota = ".$_POST["nota"]." 
            	    WHERE id = ".$id;
	
	Conexao::executar( $query );
}

	  
$sql = "SELECT nome FROM inscritos_fadergs WHERE id = ".$id;

$result = Conexao::consultar($sql);
$dados = mysqli_fetch_assoc( $result );
if( $dados["nome"] == $nome ){
	header("Location: ../presencaConfirmada.php?n=".$nome."&t=".$token);
}else{
	header("Location: erro.php?t=".$token);
}

