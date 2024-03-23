<?php 


require_once "../../class/conexion.php";
require_once "../../class/usuarios.php";


$id = $_POST['idusuario'];

$obj= new usuarios();

echo $obj->eliminausuario($id);


 ?>