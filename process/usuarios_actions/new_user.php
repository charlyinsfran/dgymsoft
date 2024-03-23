<?php 

session_start();
require_once "../../class/conexion.php";
require_once "../../class/usuarios.php";

$ide = $_POST['ide'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$usuarionombre = $_POST['user'];
$contrasenha = sha1($_POST['password']);
$id_rol = $_POST['tipousuario'];




date_default_timezone_set('America/Asuncion');
$fecha = date('Y-m-d H:i:s');

$datos = array($ide,$nombre,$apellido,$email,$telefono,$usuarionombre,$contrasenha,$id_rol);

$obj = new usuarios();

echo $obj->new_usuario($datos);


