<?php

require_once "../../class/conexion.php";
require_once "../../class/planes.php";



$datos = array($_POST['idee'],$_POST['descripcion_update'],$_POST['moneda_update'],$_POST['costo_update'],$_POST['dias_update']);

$obj= new planes();

echo $obj->updateplan($datos);
	

	


?>