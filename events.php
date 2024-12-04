<?php

if( session_status() != PHP_SESSION_ACTIVE ){
	session_start();
}
// $_SESSION[ 'user_id'] = 1;

if( !isset( $_SESSION[ 'user_id']) || $_SESSION[ 'user_id'] <= 0){
	header("Location: index.php");
}else{
	include_once "dao/clsConexao.php";
	include_once "dao/clsEvent.php";
	
	
	$action = "";

?>


<?php require_once 'menu.php' ?>



<div class="container-fluid"  >




	<div class="row" style="height: 100px;">
			
	</div>
    
	
    
	<div class="section-header">
		<p>Certificados Fadergs</p>
		<h2>EVENTOS</h2>
	</div> 

	<div class="container text-center" >

	<!-- <form class="row row-cols-lg-auto align-items-center" method="POST" action="controller/logar.php?<?php echo $action; ?>" > -->
		<form class="align-items-center" method="POST" action="controller/salvarEvento.php?<?php echo $action; ?>" >
		
			<div class="row">
				<div class="col-12">
					<!-- <label class="visually-hidden" for="inlineFormInputGroupUsername"></label> -->
					<div class="input-group">
						<div class="input-group-text">Nome:</div>
						<input type="text" class="form-control" name="name" id="name" placeholder="Nome do Evento" required >
					</div>
				</div>
			</div>  

			<br>

			<div class="row">
				<div class="col-12">
					<div class="input-group">
						<div class="input-group-text">Data do evento:</div>
						<input type="date" class="form-control" name="date" id="date" required >
					</div>
				</div>

			</div>  
	
			<br>

			<div class="row">
				<div class="col-12">
					<div class="input-group">
						<div class="input-group-text">Quantidades de Horas do evento:</div>
						<input type="number" class="form-control" name="hours" id="hours" required >
					</div>
				</div>

			</div>  
	
			<br>

			<div class="row">
				<div class="col-12">
					<div class="input-group">
						<div class="input-group-text">Horário para fechar o formulário:</div>
						<input type="datetime-local" class="form-control" name="expires" id="expires" required >
					</div>
				</div>

			</div>  
	
			<br>

			<div class="row">
				<div class="col-12">
					<div class="text-center">
						
						<input type="submit" class="btn btn-primary" value="Salvar" >
					</div>
				</div> 
			</div>
			
				
	
		</form>

	</div>

    	<hr>





   
 
        <?php


	$events = Event::getEventsByUserId( $_SESSION['user_id'] , 1 );

	if ( $events->count() == 0){
		echo '<h3><b>Nenhum Evento cadastrado.</b></h3>';
	}else {

		echo '<table>';
		echo '<div class="row"> 
		<div class="col-1">
			<h4>Código</h4>
		</div> 
		<div class="col-5">
			<h4>Nome do Evento</h4>
		</div>
		<div class="col-2">
			<h4>Data</h4>
		</div>
		<div class="col-2">
			<h4>Data para fechar o form</h4>
		</div>   

	</div>
	<hr>';
	
		foreach ($events as $evento) {
		echo '<div class="row"> 
					<div class="col-1">
					'.$evento->id.'
					</div>';

		echo '<div class="col-5">
					'.$evento->name.'
					</div>';
		echo '<div class="col-2">
					'.$evento->dateBR.'
					</div>';

		echo '<div class="col-2">
					'.$evento->expiresBR.'
					</div>';

		echo '<div class="col-2">
				<a href="editar.php?t=' . $evento->token. '">Visualizar</a></div>
				</div>
				<hr>'; 
		}

		echo '</table>';

   	}


	/*$events = Event::getEventsByUserId( $_SESSION['user_id'] );

	if ( $events->count() == 0){
		echo '<h3><b>Nenhum Evento cadastrado.</b></h3>';
	}else {

		echo '
			<div class="row"> 
				<div class="col-1">
					<h4>Código</h4>
				</div> 
				<div class="col-5">
					<h4>Nome do Evento</h4>
				</div>
				<div class="col-2">
					<h4>Data</h4>
				</div>
				<div class="col-2">
					<h4>Data para fechar o form</h4>
				</div>   

			</div>
			<hr>';

		foreach ($events as $evento) {
		
		
			echo '
				<div class="row"> 
					<div class="col-1">
					'.$evento->id.'
					</div> 
					<div class="col-5">
					'.$evento->name.'
					</div>
					<div class="col-2">
					'.$evento->date.'
					</div>
					<div class="col-2">
					'.$evento->expires.' 
					<i class="col-2 fas fa-edit fa-lg text-info" onclick=""></i>
					</div>   

				</div>
				<hr>';
        	}

    	} */

   ?> 
    
<?php 
        
        require_once("rodape.php");


        if( isset($_REQUEST['errorToInsert'])){
            echo "<script>alert('Erro ao cadastrar o evento');</script>";
        }

        
    

}
    ?> 