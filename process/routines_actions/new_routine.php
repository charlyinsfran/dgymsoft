<?php 

session_start();
require_once "../../class/conexion.php";
require_once "../../class/routines.php";

$obj = new routines();


$idusuario = $_SESSION['iduser'];

$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
$calentamiento = $_POST['calentamiento'];
$tiempo = $_POST['tiempo'].' minutos';
$f_ejer = $_POST['first_ejercicio'];
$f_rep = $_POST['first_repeticiones'];
$s_ejer = $_POST['second_ejercicio'];
$s_rep  = $_POST['second_repeticiones'];
$t_ejer = $_POST['third_ejercicio'];
$t_rep = $_POST['third_repeticiones'];
$descanso = $_POST['descanso'].' minutos';



$datos = array($id,$descripcion,$calentamiento,$tiempo,$f_ejer,$f_rep,$s_ejer,$s_rep,$t_ejer,$t_rep,$descanso,$idusuario);

echo $obj->addroutine($datos);




?>