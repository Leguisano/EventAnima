<?php

include_once("../dao/clsConexao.php");
include_once("../dao/clsUser.php");
session_start();
$user = new User();
$user->name = $_POST["name"];
$user->email = $_POST["email"];
$password = $_POST["pass"];
$hashedPassword = md5($password);
$user->password = $hashedPassword;
$user->admin = $_POST["admin"];

if ( isset($_SESSION["user_id"] )){
	$user_id = $_SESSION["user_id"];
}else{
	$user_id = 1;
}

$id = $user->insert();

if( $id > 0 ){
	header("Location: ../events.php");
}else{
	header("Location: ../events.php?errorToInsert");	
}