<?php 
require_once "../../class/conexion.php";
require_once "../../class/trainer.php";

$obj = new trainers();
$ide = $_POST['idtrainer'];


echo json_encode($obj->obtenerdatos($ide));






?>