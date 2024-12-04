

<?php 
require_once 'menu.php'; 
include_once "dao/clsConexao.php";
include_once "dao/clsEvent.php";
include_once "./presenca/controller/clsInscritos.php";

//$token = $_GET["t"];

$event = Event::getEventByToken( $_GET['t'] );



//$token = $_GET["t"];


if( !isset( $_SESSION[ 'user_id']) || $_SESSION[ 'user_id'] <= 0){
	header("Location: index.php");
}else{
	include_once "dao/clsConexao.php";
	include_once "dao/clsEvent.php";

	$action = "";

?>

<script>

function mudarPropriedadesCampos() {
						var checkboxA = document.getElementById('floatingAluno');
						var ra = document.getElementById('divRA');
						var telefone = document.getElementById('divTel');
						var raTextInput = document.getElementById('floatingRA');
						var foneTextInput = document.getElementById('floatingFone');
                         if (checkboxA.checked) {
       						raTextInput.setAttribute('required','required');
							ra.style.display = 'block';
							telefone.style.display = 'none';	
                        } else {
							foneTextInput.setAttribute('required','required');
							telefone.style.display = 'block';
							ra.style.display = 'none';
                        }
                    }
    
    function generateFormAndQRCode() {
      <?php
      $diretorio = pathinfo( $_SERVER['SCRIPT_NAME'] );
      $diretorio =  $diretorio['dirname'];
   
      //$URL_ATUAL = "http://".$_SERVER['HTTP_HOST'].$diretorio."/presenca/index.php?t=".$event["token"];
      $URL_DESTINO = "http://".$_SERVER['HTTP_HOST'].$diretorio."/presenca/index.php?t=";
      $URL_ADMIN = "http://".$_SERVER['HTTP_HOST'].$diretorio."/presenca/formAdmin.php?t=";

      $string = $event->name;
      $s = ucfirst($string);
      $bar = ucwords(strtolower($s));
     
      ?>
     
      var qrCodeText = "<?php echo $URL_DESTINO . $event->token; ?>";

      var qrCodeContainer = document.getElementById("qrcode");
      qrCodeContainer.innerHTML = ""; 

      var qrcode = new QRCode(qrCodeContainer, {
        text: qrCodeText,
        width: 150,
        height: 150
      });
      var qrCodeTexto = document.getElementById("qrCodeText");
      qrCodeTexto.style.display = 'block';
      qrCodeTexto.value = qrCodeText;
      var tooltip = document.getElementById("buttonCopiar");
      tooltip.style.display = 'block';
      var QRCodeButton = document.getElementById("gerarQRCode");
      QRCodeButton.style.display = 'none';
      //var button = document.getElementById("downloadButton");
      //button.style.display = "block";

      var downloadButton = document.getElementById("botaoDownload");
      downloadButton.style.display = 'block';
      downloadButton.addEventListener("click", function() {
      var canvas = qrCodeContainer.querySelector("canvas");
      var imageDataURL = canvas.toDataURL("image/png");
      var link = document.createElement("a");
      link.href = imageDataURL;
      link.download = "qrcode.png";
      link.click();
      });
}

  function copiarTexto() {
    var copyText = document.getElementById("qrCodeText");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
}

   function mudarCor() {
    var tooltip = document.getElementById("buttonCopiar");
    tooltip.style.color = 'green';
    var chkmark = document.getElementById("checkmark");
    chkmark.style.display = 'inline';
}

function resetCor() {
    var tooltip = document.getElementById("buttonCopiar");
    tooltip.style.color = "";
    var chkmark = document.getElementById("checkmark");
    chkmark.style.display = 'none';
    var divQrCode = document.getElementById("qrcode");
    divQrCode.style.display = 'flex';
}

function habilitarCampos() {
  var hiddenDate = document.getElementById("hdnDate");
  var date = document.getElementById("date");
  date.removeAttribute("disabled");
  document.getElementById("expires").removeAttribute("disabled");
  var botao = document.getElementById("habilitarButton");
  var botaoAlterar =  document.getElementById("salvarButton");
  var botaoC = document.getElementById("cancelarButton");
  botao.style.display = "none";
  botaoAlterar.style.display = "inline";
  botaoC.style.display = "inline";
  hiddenDate.style.display = "block";
  date.style.display = "none";
}

function cancelar() {
  var campoData = document.getElementById("date");
  campoData.disabled = true;
  var campoExpira = document.getElementById("expires");
  campoExpira.disabled = true;
  var hiddenDate = document.getElementById("hdnDate");
  var botao = document.getElementById("habilitarButton");
  var botaoAlterar =  document.getElementById("salvarButton");
  var botaoC = document.getElementById("cancelarButton");
  botao.style.display = "inline";
  botaoAlterar.style.display = "none";
  botaoC.style.display = "none";
  hiddenDate.style.display = "none";
  campoData.style.display = "block";
}

function submitFormQRCodeAdmin(event) {
  event.preventDefault(); 

  var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
  var checkboxData = Array.from(checkboxes).map(function(checkbox) {
    return checkbox.name;
  });

  var urlDestino = "<?php echo $URL_ADMIN . $event->token; ?>";
  var url =  urlDestino + "&chkbxs=" + checkboxData.join(',');

  var qrCodeTexto = document.getElementById("qrCodeText");
  var qrCodeContainer = document.getElementById("qrcode");
  var botaoDownload = document.getElementById("botaoDownload");
  qrCodeContainer.style.display = 'none';
  qrCodeTexto.style.display = 'block';
  botaoDownload.style.display = 'none';
  qrCodeTexto.value = url;
  var tooltip = document.getElementById("buttonCopiar");
  tooltip.style.display = 'block';
  var QRCodeButton = document.getElementById("gerarQRCode");
  QRCodeButton.style.display = 'none';

  //generateQRCode(url);
}

function submitFormQRCode(event) {
  event.preventDefault(); 

  var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
  var checkboxData = Array.from(checkboxes).map(function(checkbox) {
    return checkbox.name;
  });

  var urlDestino = "<?php echo $URL_DESTINO . $event->token; ?>";
  var url =  urlDestino + "&chkbxs=" + checkboxData.join(',');

  var qrCodeTexto = document.getElementById("qrCodeText");
  qrCodeTexto.value = url;

  generateQRCode(url);
}

var qrCodeImage = null; 

function generateQRCode(link) {
  var qrCodeContainer = document.getElementById("qrcode");
  qrCodeContainer.innerHTML = "";

  var qrcode = new QRCode(qrCodeContainer, {
    text: link,
    width: 150,
    height: 150
  });

  if (qrCodeImage) {
    URL.revokeObjectURL(qrCodeImage.href); // Revoga o URL da imagem anterior
    qrCodeImage.remove(); // Remove a imagem anterior do documento
  }

  var canvas = qrCodeContainer.querySelector("canvas");
  var imageDataURL = canvas.toDataURL("image/png");
  var blob = dataURLToBlob(imageDataURL);
  var imageURL = URL.createObjectURL(blob);

  qrCodeImage = document.createElement("a");
  qrCodeImage.href = imageURL;
  qrCodeImage.download = "qrcode<?php echo $data = preg_replace('/\s+/', '', $bar); ?>.png";
  qrCodeImage.style.display = 'none';
  qrCodeContainer.appendChild(qrCodeImage);

  var qrCodeTexto = document.getElementById("qrCodeText");
  qrCodeTexto.style.display = 'block';
  qrCodeTexto.value = link;
  var tooltip = document.getElementById("buttonCopiar");
  tooltip.style.display = 'block';
  var QRCodeButton = document.getElementById("botaoQRCode");
  QRCodeButton.style.display = 'none';

  var downloadButton = document.getElementById("botaoDownload");
  downloadButton.style.display = 'block';
  downloadButton.onclick = function() {
    qrCodeImage.click();
  };
}

function dataURLToBlob(dataURL) {
  var parts = dataURL.split(';base64,');
  var contentType = parts[0].split(':')[1];
  var byteString = atob(parts[1]);
  var arrayBuffer = new ArrayBuffer(byteString.length);
  var uint8Array = new Uint8Array(arrayBuffer);
  for (var i = 0; i < byteString.length; i++) {
    uint8Array[i] = byteString.charCodeAt(i);
  }
  return new Blob([arrayBuffer], { type: contentType });
}

function resubmitFormQRCode(event) {
  event.preventDefault(); 

  var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
  var checkboxData = Array.from(checkboxes).map(function(checkbox) {
    return checkbox.name;
  });

  var urlDestino = "<?php echo $URL_DESTINO . $event->token; ?>";
  var url =  urlDestino + "&chkbxs=" + checkboxData.join(',');

  regenerateQRCode(url);
}

function regenerateQRCode(link) {
  var qrCodeContainer = document.getElementById("qrcode");
  qrCodeContainer.innerHTML = "";

  var qrCodeTexto = document.getElementById("qrCodeText");
  qrCodeTexto.style.display = 'block';
  qrCodeTexto.value = link;

}

function mostrarGerarNovamente() {
  //var qrCode = document.getElementById("qrcode");
  var botaoGerarNovamente = document.getElementById("gerarNovamente");
  var downloadButton = document.getElementById("botaoDownload");
  downloadButton.style.display = 'block';
  botaoGerarNovamente.style.display = "inline";
  var botaoQrCode = document.getElementById("botaoQRCode");
  botaoQrCode.style.display = "none";
  //qrcode.style.display = 'flex';
  //document.getElementById("gerar").click();

}

function resultGerarNovamente() {
  var qrCodeContainer = document.getElementById("qrcode");
  qrCodeContainer.textContent = ""; 
  var qrCodeTexto = document.getElementById("qrCodeText");
  qrCodeTexto.style.display = 'none';
  var tooltip = document.getElementById("buttonCopiar");
  tooltip.style.display = 'none';
  tooltip.style.color = '';
  var chkmark = document.getElementById("checkmark");
  chkmark.style.display = 'none';
  var botaoGerarNovamente = document.getElementById("gerarNovamente");
  var downloadButton = document.getElementById("botaoDownload");
  downloadButton.style.display = 'none';
  botaoGerarNovamente.style.display = "none";
  var botaoQrCode = document.getElementById("botaoQRCode");
  botaoQrCode.style.display = 'inline';

}

</script>

<div class="container-fluid"  >

	<div class="row" style="height: 100px;">
			
	</div>
    
	
    
	<div class="section-header">
		<p>Certificados Fadergs</p>
		<h2>EVENTOS</h2>
	</div> 

	<div class="container text-center" >

	<!-- <form class="row row-cols-lg-auto align-items-center" method="POST" action="controller/logar.php?<?php echo $action; ?>" > -->
		<form class="align-items-center" method="POST" action="controller/alterarEvento.php?t=<?php echo $event->token; ?>&id=<?php echo $event->id; ?>" >  
			<div class="row">
				<div class="col-12">
					<!-- <label class="visually-hidden" for="inlineFormInputGroupUsername"></label> -->
					<div class="input-group">
						<div class="input-group-text">Nome:</div>
						<input type="" class="form-control" value=<?php echo "'$event->name'" ?> disabled  >
					</div>
				</div>
			</div>  

			<br>

			<div class="row">
				<div class="col-12">
					<div class="input-group">
						<div class="input-group-text">Data do evento:</div>
						<input type="" class="form-control" name="date" id="date" value="<?php echo $event->dateBR; ?>" disabled >
                        <input type="date" class="form-control" style="display:none;" name="date" id="hdnDate" value="<?php echo $event->date; ?>"  >
					</div>
				</div>

			</div>  
	
			<br>

			<div class="row">
				<div class="col-12">
					<div class="input-group">
						<div class="input-group-text">Quantidades de Horas do evento:</div>
						<input type="" class="form-control" name="hours" id="hours" value="<?php echo $event->hours; ?>" disabled >
					</div>
				</div>

			</div>  
	
			<br>

			<div class="row">
				<div class="col-12">
					<div class="input-group">
						<div class="input-group-text">Horário para fechar o formulário:</div>
						<input type="datetime-local" class="form-control" name="expires" id="expires" value="<?php echo $event->expires; ?>" disabled >
						
						<!--<input type="datetime-local" class="form-control" name="expires" id="expires" value=<?php //echo "'$event->expires'" ?> disabled >-->
					</div>
				</div>

			</div>  

            <input type="text" class="form-check-input" id="id"  name="id"  value="<?php echo $event->id; ?>"  style="display:none;">

            <input type="text" class="form-check-input" id="t"  name="t"  value="<?php echo $event->token; ?>"  style="display:none;">
	
			<br>

      <?php 
    $inscritos = new Inscritos($event->id);
    $resultInscritos = $inscritos->consultarInscritos();
    if ($resultInscritos && $resultInscritos->num_rows == 0){  ?>
                <input type="button" id="habilitarButton" onclick="habilitarCampos()" class="btn btn-primary" value="Habilitar alteração de campos" >
				<input type="submit" id="salvarButton" class="btn btn-primary" value="Alterar" style="display:none;" >
                <input type="button" id="cancelarButton" onclick="cancelar()" class="btn btn-primary" style="display:none;" value="Cancelar alteração" >
      <?php } ?>          

		</form>
	</div>
</div>

<br>

<?php 
if ($resultInscritos && $resultInscritos->num_rows == 0){ ?>

<div class="container text-center" >

<h2>O formulário deve conter:</h2>

<form id="checkboxForm" onsubmit="submitFormQRCode(event)" class="align-items-center">

    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="floatingNome"  name="nome"  value="nome" disabled> 
        <label class="form-check-label" for="floatingNome">
            Nome (*Campo obrigatório)
        </label>
    </div>


    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="floatingEmail"  name="email"  value="email" disabled> 
        <label class="form-check-label" for="floatingEmail">
            E-Mail (*Campo obrigatório)
        </label>
    </div>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="floatingGenero" name="g" value="g">
        <label class="form-check-label" for="floatingGenero">
      Gênero
    </label>
  </div>

  <div class="form-check">
        <input type="checkbox" class="form-check-input" id="floatingDataNasc" name="dtN" value="dtN">
        <label class="form-check-label" for="floatingDataNasc">
      Data de Nascimento
    </label>
  </div>

  <div class="form-check">
        <input type="checkbox" class="form-check-input" id="floatingCpf" name="c" value="c">
        <label class="form-check-label" for="floatingCpf">
      CPF
    </label>
  </div>


  <div class="form-check">
        <input type="checkbox" class="form-check-input" id="floatingCidade" name="cd" value="cd">
        <label class="form-check-label" for="chkCidade">
      Cidade
    </label>
  </div>

  <div class="form-check">
        <input type="checkbox" class="form-check-input" id="floatingEstado" name="e" value="e">
        <label class="form-check-label" for="chkEstado">
      Estado
    </label>
  </div>

    <input type="text" class="form-check-input" id="token"  name="t"  value="<?php echo $event->token; ?>"  style="display:none;">

    <br>

    <input type="submit" id="botaoQRCode" class="btn btn-primary" onclick="mostrarGerarNovamente();" value="Gerar QRCode do formulário" >

    <!-- <input type="submit" id="botaoQRCode" class="btn btn-primary" value="Gerar QRCode do formulário" > -->

    <!-- <input type="button" id="gerar" class="btn btn-primary" onclick="regenerateQRCode(link)" style="display:none;" value="" > -->

    <input type="submit" id="gerarNovamente" class="btn btn-primary" onclick="resetCor(); submitFormQRCode(event)" style="display:none;" value="Gerar novamente" > 


    <?php 
        if(  isset( $_SESSION['user_id']) && $_SESSION['user_id'] == 1  ){

        echo ' <input type="submit" class="btn btn-primary" onclick="submitFormQRCodeAdmin(event);" value="Opção para Admin: gerar link de formulário" >';
        }    
		?>

    <br>

    
    
                <!--<button onclick="generateFormAndQRCode()">Gerar Formulário</button>
                <input type="submit" class="btn btn-primary" value="Alterar" > -->
                <br>
                <div style="display: flex; justify-content: center; text-align: center;" id="qrcode"></div>
                <br>
                <a id="botaoDownload" style="display:none;" href="#">Fazer Download de imagem do QRCode</a>
                <br>
                <br>
                <div class="container text-center">
                <input id="qrCodeText" type="text" class="form-control" value="" style="display:none;" readonly />
                </div>

                <a href="#" data-toggle="tooltip" title="Copiar texto do QRCode" id="buttonCopiar" style="display:none;" onclick="copiarTexto(); mudarCor()">Copiar link 
                <i class="bi bi-clipboard"></i><i class="bi bi-check-lg" id="checkmark" style="display:none;"></i>
                </a>

                <div class="tooltip bs-tooltip-top" role="tooltip">
                    <div class="arrow"></div>
                     <div class="tooltip-inner">
                       Copiar texto
                     </div>
                </div>

               
            </form>
</div>

<?php } ?>

<?php 
 $inscritos = new Inscritos($event->id);
 $contarInscritos = $inscritos->contarInscritos();
 $notas = $inscritos->listarNotas();
 $totalParticipantes = $inscritos->contarInscritos();
if ($resultInscritos && $resultInscritos->num_rows > 0){ ?>
   <div class="container-fluid">
   <table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Participantes</th>
      <th scope="col">Nota máxima</th>
      <th scope="col">Nota mínima</th>
      <th scope="col">Avaliação geral</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"></th>
      <td><?php echo $totalParticipantes ?></td>
      <?php
      if ($notas->count() > 0) { 
      foreach ($notas as $nota) {
        echo "<td>" . $nota->notaMax . "</td>";
        echo "<td>" . $nota->notaMin . "</td>";
        echo "<td>" . $nota->nota . "</td>";
    } 
  }?>
    </tr>
  </tbody>
</table>
<div class="text-center">
<form action="gerarCsv.php" method="post">
    <input type="hidden" name="evento_id" value="<?php echo $event->id ?>">
    <input type="hidden" name="n" value="<?php echo $event->name ?>">
    <button type="submit" style="display: inline;" class="btn btn-primary">Gerar arquivo de lista de inscritos</button>
</form>
</div>
</div>
<br>

<?php } ?>

<?php 
 if( isset( $_SESSION['user_id']) && $_SESSION['user_id'] == 1 && $resultInscritos && $resultInscritos->num_rows > 0 ){ ?>
 <div class="container text-center" >

<h2>Área para admin:</h2>

<form id="checkboxFormAdmin" method="POST" action="./presenca/formAdmin.php?t=<?php echo $event->token; ?>" class="align-items-center">

    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="floatingNome"  name="nome"  value="nome" disabled> 
        <label class="form-check-label" for="floatingNome">
            Nome (*Campo obrigatório)
        </label>
    </div>


    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="floatingEmail"  name="email"  value="email" disabled> 
        <label class="form-check-label" for="floatingEmail">
            E-Mail (*Campo obrigatório)
        </label>
    </div>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="floatingGenero" name="g" value="g">
        <label class="form-check-label" for="floatingGenero">
      Gênero
    </label>
  </div>

  <div class="form-check">
        <input type="checkbox" class="form-check-input" id="floatingDataNasc" name="dtN" value="dtN">
        <label class="form-check-label" for="floatingDataNasc">
      Data de Nascimento
    </label>
  </div>

  <div class="form-check">
        <input type="checkbox" class="form-check-input" id="floatingCpf" name="c" value="c">
        <label class="form-check-label" for="floatingCpf">
      CPF
    </label>
  </div>


  <div class="form-check">
        <input type="checkbox" class="form-check-input" id="floatingCidade" name="cd" value="cd">
        <label class="form-check-label" for="chkCidade">
      Cidade
    </label>
  </div>

  <div class="form-check">
        <input type="checkbox" class="form-check-input" id="floatingEstado" name="e" value="e">
        <label class="form-check-label" for="chkEstado">
      Estado
    </label>
  </div>

    <input type="text" class="form-check-input" id="token"  name="t"  value="<?php echo $event->token; ?>"  style="display:none;">

    <br>

    <input type="submit" class="btn btn-primary" onclick="submitFormQRCodeAdminPost(event);" value="Opção para Admin: preencher formulário" >

 </form>
 </div>

<?php } ?>

<div class="container-fluid"  >

	<div class="row" style="height: 100px;">
			
	</div>
    
	<h2>Cadastrar palestrante/organizador:</h2>

	<div class="container text-center" >

	<!-- <form class="row row-cols-lg-auto align-items-center" method="POST" action="controller/logar.php?<?php echo $action; ?>" > -->
		<form class="align-items-center" method="POST" action="./presenca/controller/salvarInscrito.php?a=<?php echo $event->id;?>&t=<?php echo $event->token;?>" >  
			<div class="row">
				<div class="col-12">
					<!-- <label class="visually-hidden" for="inlineFormInputGroupUsername"></label> -->
					<div class="input-group">
						<div class="input-group-text">Nome:</div>
						<input type="text" class="form-control" name="nome" id="nome" placeholder="Nome completo" required >
					</div>
				</div>
			</div>  

			<br>

			<div class="row">
				<div class="col-12">
					<div class="input-group">
						<div class="input-group-text">Email:</div>
						<input type="email" class="form-control" name="email" id="email" placeholder="nome@examplo.com" required >
					</div>
				</div>

			</div>  
	
			<br>

			<div class="row">
				<div class="col-12">
					<div class="input-group">
						<div class="input-group-text">Informe o tipo de participação:</div>
                        <select class="custom-select" id="instrutor" required>
                        <option selected>Selecione...</option>
                        <option value="1">Palestrante</option>
                        <option value="2">Organizador</option>
                        </select>
					</div>
				</div>

			</div>  
	
			<br>
			<br>

				<input type="submit" class="btn btn-primary" value="Salvar" >

		</form>
	</div>
</div>

    <?php 
        
        require_once("rodape.php");

       
        if( isset($_REQUEST['errorToUpdate'])){
            echo "<script>alert('Erro ao alterar o evento');</script>";
        }

	}

    ?> 
