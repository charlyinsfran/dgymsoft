<?php 

session_start();
$operacion = $_REQUEST['operacion'];
$dato_cliente = "";
/*echo "<pre>";
print_r($_REQUEST);
echo "<pre>";*/



switch ($operacion) {
	case 'agregar_cliente':
    cargar_cliente();
    break;

    case 'eliminarclienteselect':
    vaciar_cliente();
    break;


    case 'anular':
    vaciar_cliente();
    break;


    case 'guardar':
   guardar();
    break;

    
}


function cargar_cliente()
{

   include ("../../class/conexion2.php");
   if (empty($_REQUEST['dato'])) {
    header("location:../ficha_paciente.php?error=1");
} 
else {
    $dato_cliente = $_REQUEST['dato'];
    $clientesgym = $bd->query("SELECT * FROM tb_clientes where id_clientes  = '$dato_cliente' OR cedula = '$dato_cliente'")->fetch(PDO::FETCH_OBJ);
    $_SESSION['cliente_gym'] = $clientesgym;

    if (empty($clientesgym)) {
        header("location:../ficha_paciente.php?error=2");
        unset($_SESSION['cliente_gym']);
    } else {


        if($clientesgym->estado == "INACTIVO"){
            unset($_SESSION['cliente_gym']);
             header("location:../ficha_paciente.php");
              header("location:../ficha_paciente.php?aviso=3");
        }else{

        	

            header("location:../ficha_paciente.php");
            header("location:../ficha_paciente.php?aviso=1");
        }
    }
}
}

function vaciar_cliente(){
	unset($_SESSION['cliente_gym']);
	header("location:../ficha_paciente.php");
}



function guardar(){



    include ("../../class/conexion2.php");
    
    date_default_timezone_set('America/Asuncion');
    $fecha = date('Y-m-d');


    $cliente = $_SESSION['cliente_gym']->id_clientes;
    $periodo_control = $_REQUEST['periodo'];
    $last_control = $_REQUEST['fecha_lastcontrol'];
    $peso_actual = $_REQUEST['pesoactual'];
    $diferencia = $_REQUEST['diferencia'];





    $bd->query("INSERT INTO tb_fichacliente(tb_clientes,periodocontrol,fecha_lastcontrol,fecha_actual,
        pesoactual,avance)values ('$cliente','$periodo_control','$last_control','$fecha','$peso_actual','$diferencia')");
    vaciar_cliente();
}

function prueba(){
    echo "<pre>";
    print_r($_REQUEST);
    echo "<pre>";
}



?>