<?php


session_start();

if (isset($_SESSION['usuario'])) {

  require_once "../class/conexion.php";
  $c = new conectar();
  $conexion = $c->conexion();
  $sesiontipo = $_SESSION['tipousuario'];
  
  //query para mostrar la cantidad de productos del sistema
  $sql = "SELECT count(id_entrenadores) from tb_entrenadores";
  $result = mysqli_query($conexion, $sql);


  $sql = "SELECT count(id_clientes) from tb_clientes";
  $result_clientes = mysqli_query($conexion, $sql);


  $sql = "SELECT SUM(montopagado) from tb_pagos WHERE MONTH(fecha_actual) = MONTH(CURRENT_DATE())";
  $result_pagos = mysqli_query($conexion, $sql);

  

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../pictures/images/home.png">
    <link rel="stylesheet" type="text/css" href="../libraries/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../libraries/css/font-awesome.css">


    <script src="../libraries/bootstrap/js/bootstrap.min.js"></script>
    <script src="../libraries/js/jquery1.js"></script>

    <title>INICIO</title>
    <?php require_once "menu.php"; ?>
  </head>

   <body>
   	<br><br><br><br><br><br><br>
   	
    <div class="container" id="container">
      <div class="row" style="width: 1200px; margin-top:-5em;">
        
        <div class="col-lg-3 col-sm-6">
          <div class="circle-tile">
            <a href="#">
              <div class="circle-tile-heading dark-blue"><i class="glyphicon glyphicon-dashboard gi-1" style="padding-top: 10px;"></i></div>
            </a>
            <div class="circle-tile-content dark-blue">
              <div class="circle-tile-description text-faded"> Trainers</div>
              <div class="circle-tile-number text-faded "><?php while ($ver = mysqli_fetch_row($result)) : echo $ver[0];
                                                          endwhile; ?></div>
              <a class="circle-tile-footer" href="trainers.php">Ver<i class=""></i></a>
            </div>
          </div>
        </div>




        <div class="col-lg-3 col-sm-6">
          <div class="circle-tile ">
            <a href="#">
              <div class="circle-tile-heading purple"><i class="glyphicon glyphicon-credit-card gi-1" style="padding-top: 10px;"></i></div>
            </a>
            <div class="circle-tile-content purple">
              <div class="circle-tile-description text-faded"> Clientes </div>
              <div class="circle-tile-number text-faded "><?php while ($ver = mysqli_fetch_row($result_clientes)) : echo $ver[0];
                                                          endwhile; ?></div>
              <a class="circle-tile-footer" href="clientes.php">Ver<i class=""></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <div class="circle-tile ">
            <a href="#">
              <div class="circle-tile-heading green"><i class="glyphicon glyphicon-usd gi-1" style="padding-top: 10px;"></i></div>
            </a>
            <div class="circle-tile-content green">
              <div class="circle-tile-description text-faded"> Pagos del Mes </div>
              <div class="circle-tile-number text-faded "><?php while ($ver = mysqli_fetch_row($result_pagos)) : echo 'GS. ' . number_format($ver[0], 0, ",", ".");
                                                          endwhile; ?></div>
              <a class="circle-tile-footer" href="pagos.php">Ver<i class=""></i></a>
            </div>
          </div>
        </div>
        
     



      </div>


<?php
} else {
  header("location:../index.php");
}
?>
