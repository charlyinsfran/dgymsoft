<?php
session_start();
require_once "../../class/conexion.php";
require_once "../../class/planes.php";

//$idusuario = $_SESSION['iduser'];

$descripcion = $_POST['descripcion'];
$moneda = $_POST['moneda'];
$costo = $_POST['costo'];
$cant = $_POST['dias'];


date_default_timezone_set('America/Asuncion');
$fecha = date('Y-m-d');

$datos = array($descripcion,$moneda,$costo,$cant);

$obj = new planes();

echo $obj->addplan($datos);


?>



