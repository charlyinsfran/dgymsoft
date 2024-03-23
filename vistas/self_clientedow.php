<?php
session_start();
if (isset($_SESSION['usuario'])) {
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../pictures/iconos/borrar.png">
    <title>Baja Clientes</title>
    <?php 
    require_once "menu.php";

    require_once "../class/conexion.php";
    $c = new conectar();
    $conexion = $c->conexion();



    ?>

    
</head>
<br>
<br>

<body>
    <div class="col-sm-1">
        <div class="container">
            <div class="row"></div>
        </div>
    </div>

    <div class="col-sm-10">
        <br>
        <h3 style="text-align: center;">List Clientes</h3>
        <div id="tablerutinaload" style="align-content:left;">

        </div>

    </div>

    

</body>

</html>



<script type="text/javascript">
    $(document).ready(function() {
        $('#tablerutinaload').load("pagosmod/bajacliente.php");
        
    });
</script>






<script>

    function bajacliente(ide) {
        alertify.confirm('¿Desea dar de baja este cliente?', function() {
            $.ajax({
                type: "POST",
                data: "ide=" + ide,
                url: "../process/pagos_actions/baja_cliente.php",
                success: function(r) {
                    if (r == true) {
                        $('#tablerutinaload').load("pagosmod/bajacliente.php");
                        DataTable.reload();
                        alertify.success("Cliente inhabilitado");
                    } else {
                        alertify.error("No se pudo eliminar");
                    }
                }
            });
        }, function() {
            alertify.error('Operacion Cancelada')
        });

    }
</script>

<?php
} else {
    header("location:../index.php");
}
?>