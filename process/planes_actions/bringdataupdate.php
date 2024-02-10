<?php 
require_once "../../class/conexion.php";
require_once "../../class/planes.php";

$obj = new planes();
$ide = $_POST['idplan'];


echo json_encode($obj->bringdata($ide));






?>