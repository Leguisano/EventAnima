
<?php // include_once("controller/clsConexao.php"); ?>

<?php
if( session_status() != PHP_SESSION_ACTIVE ){
	session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Eventos FADERGS</title>
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

        <!-- Biblioteca QRCode -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
        <!-- Bootstrap icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <!-- Biblioteca Canvas -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
        <!-- JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


    </head>

    <body>
 
        <!-- Top Bar Start -->
        <div class="top-bar d-none d-md-block">
            <div class="container-fluid">
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
        <div class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container-fluid">
                <a href="index.php" class="navbar-brand">CERTIFICADOS</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                        <!-- <a href="https://forms.office.com/r/bDd0sbkuWv" target="_blank" class="nav-item nav-link">Avaliação</a> -->
                        <a href="index.php" class="nav-item nav-link">Início</a>
                        <a href="./" class="nav-item nav-link">Meus Certificados</a> 
                        <!-- <a href="programacao.php" class="nav-item nav-link">Programação</a> -->
			            
                       
                        <?php 
                             if(  isset( $_SESSION['user_id']) && $_SESSION['user_id'] == 1  ){

                                echo '<a href="cadastrarUsuarios.php" class="nav-item nav-link">Cadastrar Usuários</a>';
                            }    
                            if(  isset( $_SESSION['user_id']) && $_SESSION['user_id'] != 0  ){

                                echo '<a href="events.php" class="nav-item nav-link">Eventos</a>';
                                echo '<a href="sobre.php" class="nav-item nav-link">Sobre</a>';
                                echo '<a href="controller/sair.php" class="nav-item nav-link">Sair</a>';
                            }else{
                                echo '<a href="login.php" class="nav-item nav-link">Login</a>';
                            }
		                ?>

                    </div>
                        
                </div>
		    
            </div>
                
        </div>
            
        <!-- </div> -->
        
        <!-- Nav Bar End -->

