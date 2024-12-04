<?php

include_once("../dao/clsConexao.php");
include_once("../dao/clsEvent.php");
session_start();
$date = $_POST['date'];
$expires = $_POST['expires'];
$eventoId = $_POST['id'];
$token = $_POST['t'];

$event = new Event();

$event->update($eventoId, $date, $expires);

$event->getEventByToken($token);

$_SESSION['mensagem'] = "Evento atualizado com sucesso.";

header("Location: ../editar.php?t=" .$token);






