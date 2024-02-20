<?php
require_once "../../class/conexion.php";
require_once "../../class/clientes.php";

$obj = new clientes();

/*date_default_timezone_set('America/Asuncion');
$fecha = date('Y-m-d');*/


$ide = $_POST['id_update'];
$nombre = $_POST['nombre_update'];
$apellido = $_POST['apellido_update'];
$cedula = $_POST['cedula_update'];
$ocupacion = $_POST['ocupacion_update'];
$nacimiento = $_POST['fecha_nacimiento_update'];
$email = $_POST['email_update'];
$telefono = $_POST['telefono_update'];
$direccion = $_POST['direccion_update']; 
$ciudad = $_POST['ciudad_update']; 
$peso = $_POST['peso_update']; 
$altura = $_POST['altura_update'];
$imc = $_POST['imc_update'];


$datos = array($ide,$nombre,$apellido,$cedula,$ocupacion,$nacimiento,$email,$telefono,$direccion,$ciudad,$peso,$altura,$imc);

echo $obj->actualizardatos($datos);


?>