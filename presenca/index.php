<?php 

	if( isset($_GET["t"]) ){
		
		$vencido = false;

		$abrir = true;
		$token = $_GET["t"];

        include_once('controller/clsConexao.php');

        $sql = "SELECT id, name, DATE_FORMAT(date, '%d/%m/%Y') AS date, expires 
                FROM event
                WHERE token = '$token'";

        $result = Conexao::consultar( $sql );

        if( mysqli_num_rows($result) > 0 ){
            $atividade = mysqli_fetch_assoc($result);

            $agora = date("Y-m-d H-i-s");
            if ( $agora > $atividade['expires']) $vencido = true ;
            

            $dia = $atividade['date'];

        }else{
			$abrir = false;
        }

		
		
		
	}else{
		$abrir = false;
	}

	if( !$abrir ) 
		    header("Location: ../index.html?erroToken");
	else{

        ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Eventos FADERGS - Registro de Presença</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="FADERGS Certificados" name="keywords">
        <meta content="FADERGS Certificados" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Lato&family=Oswald:wght@200;300;400&display=swap" rel="stylesheet">
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">

         <!-- JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
	function validar(){
		var ies = document.getElementById("floatingIES");
		if( ies.value == 0 ){
			alert("Selecione a sua Universidade (IES)!");
		}else{
			// document.getElementById("formulario").submit();
			return true;
		}
	}
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
    
</script>

    </head>

    <body>
        <!-- Top Bar Start -->
        <div class="top-bar d-none d-md-block">
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-md-8">
                        <div class="top-bar-left">
                            <!--<div class="text">
                                <i class="far fa-clock"></i>
                                <h2>8:00 - 9:00</h2>  
                                <p>Mon - Fri</p>
                            </div> 
                            <div class="text">
                                <i class="fa fa-phone-alt"></i>
                                <h2>+123 456 7890</h2>
                                <p>For Appointment</p>
                            </div>-->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="top-bar-right">
                            <div class="social">
                                <a href="https://twitter.com/animaedu"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.facebook.com/AnimaEducacao"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.linkedin.com/company/animaeducacao/"><i class="fab fa-linkedin-in"></i></a>
                                <a href="https://www.instagram.com/anima.educacao"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->

        <!-- Nav Bar Start -->
        <!-- <div class="navbar navbar-expand-lg bg-dark navbar-dark"> -->

        <div class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container-fluid">
                <a href="index.html" class="navbar-brand">Eventos FADERGS</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                        <!-- <a href="sobre.html" class="nav-item nav-link">Sobre</a> -->
       
                        <!--<a href="https://certificadosanimatic.com.br/fadergseventos/" class="nav-item nav-link">Certificados</a>-->
                        <a href="../" class="nav-item nav-link">Certificados</a>
                        
												
                        <!-- <a href="https://sites.google.com/view/techweek4/p%C3%A1gina-inicial" class="nav-item nav-link">Tech Week Experience</a> -->
                        <!-- <a href="calendario.html" class="nav-item nav-link">Calendário</a> -->
						<!-- <a href="contato.html" class="nav-item nav-link">Contato</a> -->
                       
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Nav Bar End -->


        

        <!-- Video Modal Start-->
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>        
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- Video Modal End -->

        <div class="top-bar d-none d-md-block" style="height: 78px; ">
  
        </div>
 
         <!-- <div class="row" style="height: 100px;"></div> -->
        
      <div class="container-fluid">

        <div class="container">
            <!-- <div class="row">
              <div class="col">
              <img src="img/fundo.jpeg" class="img-fluid" alt="..."  width="80%" />
              </div>
              
            </div> -->
      
            
            
            <div class="row">
              <div class="col">
                  <h1></h1>
                  <h1 class="h3 mb-3 fw-normal">Formulário de presença do dia <b><?php echo $dia; ?>, na atividade:</b></h3>
                  <h3 class="h1 mb-3 fw-normal"><b><?php echo $atividade['name']; ?></b></h1>
      <?php 

        include_once("controller/clsConexao.php");



          if( $vencido) 
              echo '<hr> <h3 class="h3 mb-3 fw-normal"> Prazo encerrado para registro de presença nesta atividade!</h3>
              </div>
              </div> <br><br><br>';
          else{
          ?>
      
              <h3 class="h3 mb-3 fw-normal"> Preencha com atenção!</h3>
              </div>
            </div>
            
            <div class="row">
              <div class="col">
                  <!-- <main class="form-signin"> -->
                      
                      
      
                      
                    <form action="controller/salvarInscrito.php?a=<?php echo $atividade['id'];?>&t=<?php echo $token;?>" method="POST" id="formulario">
                    <div class="form-floating">
                        <label for="floatingEmail">E-mail:</label>
                        <input type="email" class="form-control" id="floatingEmail" placeholder="nome@exemplo.com" name="email" required >
                    
                    </div>

		<br>
       
		<div class="form-floating">
            <label for="floatingNome">Nome Completo:</label>
            <input type="text" class="form-control" id="floatingNome" placeholder="Nome Completo" name="nome" required >
        </div>

		<br>

        <div class="form-floating">
            <label for="floatingAlunoOuNao">Informe: </label>
        </div>

        <div class="form-floating">
    <div class="form-check">
        <input type="radio" class="form-check-input" id="floatingAluno"  name="alunoOuNao"  value="aluno" onchange="mudarPropriedadesCampos()" > 
        <label class="form-check-label" for="floatingAluno">
            Sou Aluno
        </label>
    </div>
</div>
    <div class="form-check">
        <input class="form-check-input" type="radio" class="form-check-input" id="floatingNaoAluno"  name="alunoOuNao"  value="naoAluno" onchange="mudarPropriedadesCampos()" > 
        <label class="form-check-label" for="floatingNaoAluno">
            Não sou Aluno
        </label>
    </div>

    <br>
    
    <div id="divRA" class="form-floating" style='display:none;'>
                <label for="floatingRA">RA: (somente números)</label>
                <input type="text" class="form-control" id="floatingRA" placeholder="0000000000 (somente números)" name="ra"  >
            </div>


        <div id="divTel" class="form-floating" style='display:none;'>
            <label for="floatingFone">Telefone: </label>
            <input type="tel" class="form-control" id="floatingFone" placeholder="(XX)XXXXX-XXXX" name="fone" >
            
        </div> 

        <br>

        <?php
        if (isset($_GET['t'])) {
        $token = $_GET['t'];

        if (isset($_GET['chkbxs'])) {
         $checkboxes = $_GET['chkbxs'];
         $checkboxData = explode(',', $checkboxes);

         if (in_array('dtN', $checkboxData)) {
            echo ' <div id="campoDataNascimento"class="form-floating">
                 <label for="floatingNasc">Data de Nascimento DD/MM/AAAA: </label>
                <input type="date" class="form-control" id="floatingNasc" placeholder="Data de Nascimento DD/MM/AAAA: " name="nasc" required >
                </div>
                <br>';
        }

        if (in_array('c', $checkboxData)) {
            echo '  <div class="form-floating">
            <label for="floatingCPF">CPF: </label>
            <input type="text" class="form-control" id="floatingCPF" placeholder="0000000000 (somente números)" name="cpf" required >
            </div>
            <br>';
         }
         if (in_array('g', $checkboxData)) {
            echo '   <div id="campoGenero">       
            <div class="form-floating" >
                <label for="floatingSexo">Qual gênero você se identifica? </label>
            </div>
          
            
            <div class="form-floating">
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="floatingSexoF"  name="sexo" required value="feminino"> 
                    <label class="form-check-label" for="floatingSexoF">
                        Feminino
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" class="form-check-input" id="floatingSexoM"  name="sexo" required value="masculino"> 
                    <label class="form-check-label" for="floatingSexoM">
                        Masculino
                    </label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="floatingSexoO" name="sexo" required value="outro"> 
                    <label class="form-check-label" for="floatingSexoO">
                        Outro
                    </label>
                </div>    
            </div>
            </div>
            <br>';
         }
         if (in_array('cd', $checkboxData)) {
            echo '  <div class="form-floating">
            <label for="floatingCidade">Cidade: </label>
            <input type="text" class="form-control" id="floatingCidade" placeholder="Cidade/Município" name="cidade" required >
        </div>

		<br>';
         }

         if (in_array('e', $checkboxData)) {
            echo '  <div class="form-floating">
            <label for="floatingEstado">Estado: </label>
            <input type="text" class="form-control" id="floatingEstado" placeholder="Sigla do Estado (PR, RS, SC, ...)" name="estado" required >
        </div>

		<br>';
         }

        } 
    }
        ?>

        <div class="form-floating">
            <label for="floatingSexo">Em uma escala de 1 a 10, o quanto você recomendaria este evento para um amigo ou colega?</label>
        </div>

        <!--<div class="form-check form-check-inline">-->
        <!--    <input class="form-check-input" type="radio" name="nota" id="nota-1" value="-1" required >-->
        <!--    <label class="form-check-label" for="nota-1">Não Avaliar</label>-->
        <!--</div>-->
        <!--<div class="form-check form-check-inline">-->
        <!--    <input class="form-check-input" type="radio" name="nota" id="nota0" value="0" required >-->
        <!--    <label class="form-check-label" for="nota0">0</label>-->
        <!--</div>-->
        
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="nota" id="nota1" value="1" required >
            <label class="form-check-label" for="nota1">1</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="nota" id="nota2" value="2" required >
            <label class="form-check-label" for="nota2">2</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="nota" id="nota3" value="3" required >
            <label class="form-check-label" for="nota3">3</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="nota" id="nota4" value="4" required >
            <label class="form-check-label" for="nota4">4</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="nota" id="nota5" value="5" required >
            <label class="form-check-label" for="nota5">5</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="nota" id="nota6" value="6" required >
            <label class="form-check-label" for="nota6">6</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="nota" id="nota7" value="7" required >
            <label class="form-check-label" for="nota7">7</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="nota" id="nota8" value="8" required >
            <label class="form-check-label" for="nota8">8</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="nota" id="nota9" value="9" required >
            <label class="form-check-label" for="nota9">9</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="nota" id="nota10" value="10" required >
            <label class="form-check-label" for="nota10">10</label>
        </div>
        
		<br>
        <br>
		
		<!-- <input class="form-control" type="text" value="Ao clicar em enviar, você concorda com o compartilhamento de seus dados com o SEBRAE RS, parceiro deste evento!" aria-label="readonly input example" readonly> -->
		<!--<h5>Se a atividade que você participou foi promovida pelo Sebrae, ao clicar em enviar, você concorda com o compartilhamento de seus dados com o SEBRAE SC, parceiro deste evento!</h5>-->
<br>
		
        
      
               
                      <button class="w-100 btn btn-lg btn-primary" type="submit" onclick="validar()">Enviar</button>
                      <!--<button class="w-100 btn btn-lg btn-primary" type="submit" onclick="validar()">Enviar</button>-->
                      <!-- <p class="mt-5 mb-3 text-muted">&copy; 2022</p> -->
                    </form>
                  <!-- </main> -->
              </div>
              
            </div>
      
            <?php
          }
          ?>
          </div>

      </div>
        
        
        
       

        <!-- Footer Start -->
        <div class="footer">
            
            <div class="container copyright">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; <a href="#">TI&C Ânima</a>, Todos os direitos reservados.</p>
                    </div>
                    <div class="col-md-6">
                        <p>Projetado pelo time de TI&C Ânima</p>
                        <p>Desenvolvido pelo Prof. MSc. Adalto Selau Sparremberger</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        
        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>

<?php
    }
