<?php 

session_start();
require_once "../../class/conexion.php";
require_once "../../class/routines.php";

$obj = new routines();

$idusuario = $_SESSION['iduser'];

$id = $_POST['id_update'];
$descripcion = $_POST['descripcion_update'];
$calentamiento = $_POST['calentamiento_update'];
$tiempo = $_POST['tiempo_update'];
$f_ejer = $_POST['first_ejercicio_update'];
$f_rep = $_POST['first_repeticiones_update'];
$s_ejer = $_POST['second_ejercicio_update'];
$s_rep  = $_POST['second_repeticiones_update'];
$t_ejer = $_POST['third_ejercicio_update'];
$t_rep = $_POST['third_repeticiones_update'];
$descanso = $_POST['descanso_update'].' minutos';



$datos = array($id,$descripcion,$calentamiento,$tiempo,$f_ejer,$f_rep,$s_ejer,$s_rep,$t_ejer,$t_rep,$descanso,$idusuario);

echo $obj->updateroutine($datos);




?>