<?php 


session_start();
require_once "../../class/conexion.php";
require_once "../../class/pagos.php";

$factura = $_POST['factura'];
$cliente = $_POST['cliente'];
$plan = $_POST['plan'];
$monto = str_replace ( ".", "", $_POST['monto']);
date_default_timezone_set('America/Asuncion');
$fecha_actual = date('Y-m-d');
$vencimiento = $_POST['vencimiento'];

$datos = array($factura,$cliente,$plan,$monto,$fecha_actual,$vencimiento);

$obj = new pagos();

echo $obj->new_pago($datos);


 ?>