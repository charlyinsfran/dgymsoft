<?php 


session_start();
require_once "../../class/conexion.php";
require_once "../../class/pagos.php";

$factura = $_POST['idpago'];

$obj = new pagos();

echo $obj->anularpago($factura);


 ?>