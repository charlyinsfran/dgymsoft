<?php 
require_once "../../class/conexion.php";
require_once "../../class/trainer.php";

$obj = new trainers();
$ide = $_POST['ide'];


echo json_encode($obj->eliminar($ide));






?>