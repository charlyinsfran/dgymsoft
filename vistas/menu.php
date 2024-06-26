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
  $iduser = $_SESSION['iduser'];

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

            <?php if($sesion == "trainer" || $sesion == "admin" || $sesion == "ADMIN"){ ?>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class=" glyphicon glyphicon-unchecked">
                  <p></p>
                </span> Training <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="trainers.php">Entrenadores</a></li>
                <li><a href="routines.php">Routines</a></li>
              </ul>
            </li>

          <?php } ?>
           

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-qrcode">
                  <p></p>
                </span> Clientes <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="clientes.php">Registro de Datos</a></li>
                <li><a href="ficha_paciente.php">Ficha</a></li>
                <li><a href="reportes.php">Reportes</a></li>
              
              </ul>
            </li>
            
           <?php if($sesion == "admin") {?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-cog">
                  <p></p>
                </span> Config. <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="usuarios.php">Usuarios</a></li>
                <li><a href="operaciones_database.php">Backup/Restore</a></li>
                
              </ul>
            </li>

          <?php } ?>
        
            <li><a href="planes.php"><span class="glyphicon glyphicon-th-large"></span> Plans </a>
            </li>


            

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-usd"></span> Pagos <span class="caret"></span></a>

              <ul class="dropdown-menu">


                <li>
                  <a href="pagos.php">Generar Pago</a>
                  <a href="self_clientedow.php">Dar de Baja</a>
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



