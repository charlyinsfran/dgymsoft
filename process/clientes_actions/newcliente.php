<?php


/*session_start();
$idusuario = $_SESSION['iduser'];
*/
require_once "../../class/conexion.php";
require_once "../../class/clientes.php";

$obj = new clientes();

date_default_timezone_set('America/Asuncion');
$fecha = date('Y-m-d');

$ide = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cedula'];
$ocupacion = $_POST['ocupacion'];
$nacimiento = $_POST['fecha_nacimiento'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion']; 
$ciudad = $_POST['ciudad']; 
$peso = $_POST['peso']; 
$altura = $_POST['altura'];
$imc = $_POST['imc'];




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
        $datos[4] = $ocupacion;
        $datos[5] = $nacimiento;
        $datos[6] = $email;
        $datos[7]= $ciudad;
        $datos[8] = $telefono;
        $datos[9] = $direccion;
        $datos[11] = $peso;
        $datos[10] = $altura;
        $datos[12] = $imc;
        $datos[13]= $idimagen;

        echo $obj->newcliente($datos);

    }

}

?>