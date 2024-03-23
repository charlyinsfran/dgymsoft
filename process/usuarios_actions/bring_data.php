<?php 
require_once "../../class/conexion.php";
require_once "../../class/usuarios.php";

$obj = new usuarios();
$ide = $_POST['idusuario'];


echo json_encode($obj->obtenerdatos($ide));






?>