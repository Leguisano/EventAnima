<?php

    include_once "../dao/clsConexao.php";
	include_once "../dao/clsUser.php";


    $email = $_POST['email'];
    $pass = md5( $_POST['pass'] );

    $user = User::getUserByLogin( $email , $pass);

    if( $user != null ){
        session_start();
        $_SESSION["logado"] = TRUE;
        $_SESSION["user_id"] = $user->id;
        $_SESSION["name_user"] = $user->name;
        $_SESSION["admin"] = $user->admin;
        header( "Location: ../events.php" );
    }else{
        header( "Location: ../login.php?erroNoLogin" );
    }
?>