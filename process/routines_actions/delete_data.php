<?php 
require_once "../../class/conexion.php";
require_once "../../class/routines.php";


$ide = $_POST['ide'];

$obj = new routines();


echo $obj->deleteroutine($ide);






?>