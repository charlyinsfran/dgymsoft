<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INICIO</title>
<?php
  
  require_once "dependencias.php";
  require_once "../class/conexion.php";
  
  $c = new conectar();
  $conexion = $c->conexion();

  $sesion = $_SESSION['usuario'];
  $tipo = $_SESSION['tipousuario'];

  ?>

</head>

<body>
  


  <div id="nav">
    <div class="navbar navbar-default navbar-fixed-top" data-spy="affix" data-offset-top="-20">
      <div class="container" style="color:blue;">
        <div class="navbar-header" >
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
           aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>

          </button>

        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav navbar-right">

            <li><a href="inicio.php"><span class="glyphicon glyphicon-scale"
             data-toggle="modal" data-target="#presentacion"></span> Inicio </a></li>


            </li>
            <li><a href="trainers.php"><span class="glyphicon glyphicon-object-align-horizontal"></span> Entrenadores </a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-qrcode">
                  <p></p>
                </span> Clientes <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="clientes.php">Registro de Datos</a></li>
                <li><a href="Ficha Clientes">Ficha Cliente</a></li>
                

              </ul>
            </li>


            <li><a href="usuarios.php"><span class="glyphicon glyphicon-user"></span>Usuarios</a>
            </li>
        
            <li><a href="planes.php"><span class="glyphicon glyphicon-th-large"></span> Planes </a>
            </li>


            

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-usd"></span> Pagos <span class="caret"></span></a>

              <ul class="dropdown-menu">


                <li>
                  <a href="">Generar Pago</a>
                  <a href="compras.php">Dar de Baja</a>
                </li>

            </li>
          </ul>

          <li class="dropdown">
            <a href="#" style="color: red" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <span class="glyphicon glyphicon-user"></span> <strong style="text-decoration: underline;">Usuario:</strong> 
              <?php echo strtoupper($_SESSION['usuario']);?> <span class="caret">
              </span></a>
            <ul class="dropdown-menu">
              <li> <a style="color: red" href="../process/close.php"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
            </li>    
            </ul>
          </li>
          </ul>
        </div>
      </div>
    </div>
  </div>


</body>

</html>



