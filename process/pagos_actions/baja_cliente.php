<?php 


session_start();
require_once "../../class/conexion.php";
require_once "../../class/pagos.php";

$ide = $_POST['ide'];

$obj = new pagos();

echo $obj->bajacliente($ide);


 ?>