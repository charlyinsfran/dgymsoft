<?php

require_once "../../class/conexion.php";
require_once "../../class/usuarios.php";



$datos = array($_POST['idusuarioactualiza'],$_POST['nombreactualiza'],$_POST['apellidoactualiza'],$_POST['emailactualiza'],
$_POST['telefonoactualiza'],$_POST['useractualiza'],$_POST['tipousuarioactualiza']);

$obj= new usuarios();

echo $obj->actualizarusuarios($datos);
	

	


?>