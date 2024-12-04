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


<?php require_once 'menu.php' 
?>

    
<?php 
        
        require_once("rodape.php");


        if( isset($_REQUEST['errorToInsert'])){
            echo "<script>alert('Erro ao cadastrar o evento');</script>";
        }

        
    

}
    ?> 