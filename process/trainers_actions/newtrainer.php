<?php


/*session_start();
$idusuario = $_SESSION['iduser'];
*/
require_once "../../class/conexion.php";
require_once "../../class/trainer.php";

$obj = new trainers();

date_default_timezone_set('America/Asuncion');
$fecha = date('Y-m-d');

$ide = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cedula'];
$formacion = $_POST['formacion'];
$direccion = $_POST['direccion']; 
$ciudad = $_POST['ciudad']; 
$edad = $_POST['edad']; 




$nombre_imagen = $_FILES['imagen']['name'];
$ruta_almacenamiento = $_FILES['imagen']['tmp_name'];
$carpeta = '../../pictures/photos/';
$rutafinal = $carpeta.$nombre_imagen;



$datos=array();
$datosImg = array($nombre_imagen,$rutafinal,$fecha);


if(move_uploaded_file($ruta_almacenamiento,$rutafinal)){

    $idimagen = $obj->subir_imagen($datosImg);

    echo $idimagen;

    if($idimagen>0){
        $datos[0] = $ide;
        $datos[1] = $nombre;
        $datos[2] = $apellido;
        $datos[3] = $cedula;
        $datos[4] = $formacion;
        $datos[5] = $direccion;
        $datos[6] = $ciudad;
        $datos[7]= $edad;
        $datos[8]= $idimagen;

        echo $obj->newtrainer($datos);

    }

}

?>