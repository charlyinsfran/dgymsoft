<?php
session_start();
if (isset($_SESSION['usuario'])) {
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../pictures/iconos/planes.png">
    <title>Planes</title>
    <?php 
    require_once "menu.php";

    require_once "../class/conexion.php";
    $c = new conectar();
    $conexion = $c->conexion();



    ?>

    
</head>
<br>
<br>
<br>
<body>
    
    <div class="col-sm-12">
        <h3 style="text-align: center;">Restore / Backup</h3>
        <br>
        <div class="col-sm-5"></div>
        <div class="col-sm-6">
        <a href="../process/operaciondb_s/backup.php"><span class="boton btn btn-primary">Respaldo</span></a>
        <a href=""><span class="boton btn btn-success">Restauracion</span></a>
        </div>
    </div>


</body>

</html>



<?php
} else {
    header("location:../index.php");
}
?>