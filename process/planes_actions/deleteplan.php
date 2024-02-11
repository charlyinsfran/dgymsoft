<?php 


require_once "../../class/conexion.php";
require_once "../../class/planes.php";


$id = $_POST['idplan'];

$obj= new planes();

echo $obj->deleteplan($id);


 ?>