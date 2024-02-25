<?php 
require_once "../../class/conexion.php";
require_once "../../class/routines.php";

$obj = new routines();
$ide = $_POST['idrutina'];


echo json_encode($obj->obtenerdatos($ide));






?>