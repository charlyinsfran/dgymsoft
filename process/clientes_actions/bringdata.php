<?php 
require_once "../../class/conexion.php";
require_once "../../class/clientes.php";

$obj = new clientes();
$ide = $_POST['idcliente'];


echo json_encode($obj->obtenerdatos($ide));






?>