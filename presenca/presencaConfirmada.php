<?php 
	if( isset($_GET["t"]) ){
		
		$vencido = false;

		$abrir = true;
		$token = $_GET["t"];

        include('controller/clsConexao.php');

        $sql = "SELECT id, name, DATE_FORMAT(date, '%d/%m/%Y') AS date, expires 
                FROM event 
                WHERE token = '$token'";
        $result = Conexao::consultar( $sql );

        $atividade = mysqli_fetch_assoc($result);
    
	

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


<script>
	function validar(){
		var ies = document.getElementById("floatingIES");
		if( ies.value == 0 ){
			alert("Selecione a sua Instituição (IES)!");
		}else{
			// document.getElementById("formulario").submit();
			return true;
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
                    <h1 class="h3 mb-3 fw-normal"><?php echo $_GET['n']; ?>, confirmada sua presença do dia <b><?php echo $atividade['date']; ?>, na atividade:</b></h3>
                    <h3 class="h1 mb-3 fw-normal"><b><?php echo $atividade['name']; ?></b></h1>

                    </div>

                </div>
<hr>
                <div class="row">
                    <div class="col">
                        <a href="../">
                            <button class="btn btn-primary">Acessar a página de emissão dos certificados</button></a>

                    </div>

                </div>
            
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
