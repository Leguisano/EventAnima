<?php

include_once("../dao/clsConexao.php");
include_once("../dao/clsEvent.php");
session_start();
$event = new Event();
$event->name = $_POST["name"];
$event->date = $_POST["date"];
$event->hours = $_POST["hours"];
$event->expires = $_POST["expires"];

if ( isset($_SESSION["user_id"] )){
	$event->user_id = $_SESSION["user_id"];
}else{
	$event->user_id = 1;
}

$id = $event->insert();

if( $id > 0 ){
	header("Location: ../events.php");
}else{
	header("Location: ../events.php?errorToInsert");	
}