<?php


/*session_start();
$idusuario = $_SESSION['iduser'];
*/
require_once "../../class/conexion.php";
require_once "../../class/trainer.php";

$obj = new trainers();

date_default_timezone_set('America/Asuncion');
$fecha = date('Y-m-d');

$ide = $_POST['idtrainer'];
$nombre = $_POST['nombre_update'];
$apellido = $_POST['apellido_update'];
$cedula = $_POST['cedula_update'];
$formacion = $_POST['formacion_update'];
$direccion = $_POST['direccion_update']; 
$ciudad = $_POST['ciudad_update']; 
$edad = $_POST['edad_update']; 

$datos = array($ide,$nombre,$apellido,$cedula,$formacion,$direccion,$ciudad,$edad);

echo $obj->actualizardatos($datos);


?>