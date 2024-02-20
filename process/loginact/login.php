<?php


session_start();
require_once "../../class/conexion.php";
require_once "../../class/usuarios.php";

$obj = new usuarios();

$datos = array($_POST['usuario'],$_POST['password']);

echo $obj->loginUser($datos);

?>

