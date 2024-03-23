<?php 
session_start();
require_once "../../class/conexion.php";
require_once "../../class/clientes.php";

$obj = new clientes();
$ide = $_POST['ide'];


echo $obj->cambiarestado($ide);






?>