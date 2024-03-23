
<?php


session_start();

if (isset($_SESSION['usuario'])) {
  require_once "../class/conexion.php";
  $c = new conectar();
  $conexion = $c->conexion();
  $sesiontipo = $_SESSION['tipousuario'];
  
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../pictures/iconos/lista-de-verificacion.png">
    <link rel="stylesheet" type="text/css" href="../librerias/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/font_awesome.css">


    <script src="../librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="../librerias/jquery1.js"></script>

    <title>Reports</title>
    <?php 
    require_once "menu.php"; 
    $sql = "SELECT id_clientes,nombre,apellido from tb_clientes";
    $resultado = mysqli_query($conexion, $sql);

    ?>
  </head>

  <body>

    <?php 

    if(isset($_GET['dato'])){
      $dato = $_GET['dato'];
      $sql = "SELECT pesoactual,date(fecha_lastcontrol),avance FROM tb_fichacliente where tb_clientes = '$dato' order by fecha_lastcontrol";
    }else{
      $sql = "SELECT pesoactual,date(fecha_lastcontrol),avance FROM tb_fichacliente order by fecha_lastcontrol";
    }
    $result = mysqli_query($conexion,$sql);


  $valoresx = array(); //produccion
  $valoresy = array(); //fecha
  $diferencia = 0;
  

  while ($ver=mysqli_fetch_row($result)) {
    $diferencia = $ver[2] + $diferencia; 
    $valoresx[] = $ver[1];
    $valoresy[] = $ver[0];
    
  }


  $datosX = json_encode($valoresx);
  $datosY = json_encode($valoresy);



  ?>

  <br><br><br><br>
  <div class="container">

    <div class="row">
      <div  class="col-sm-12">
        <form action="reportes.php" method="GET">
          <label>Cliente</label>
          <input type="submit" class="btn btn-sm btn-danger" style=" position: relative; top: 40px; left: 150px; width: 110px;" value="Cargar">
<p></p>
          <select name="dato" id="dato" required style="position: absolute; top: 30px; left: 120px; width: 180px; height: 50px;">
            <option value="">Seleccione cliente:</option>
            <?php while ($view = mysqli_fetch_row($resultado)) : ?>
              <option value="<?php echo $view[0] ?>"><?php echo $view[1].' '.$view[2]; ?></option>

            <?php endwhile; ?>
          </select>
          
        </form>
      </div>
    </div>

    <br>

    <?php if(isset($_GET['dato'])){ ?>
    <div class="row" style="width: 1000px; height: 52%;">

      <div class="col-sm-12">


        

            <div class="row">
              <div class="col-sm-12">

                <div id="graficolineal"></div>

              </div>



            </div>



          </div>
        

    </div>

    <?php if($diferencia < 0){ ?>
    <input type="text" class="form-control input-md" style="width: 200px; background-color: green; color: white;" value="DIFERENCIA: <?php echo $diferencia.' kg';?>" readonly>
  <?php } else if($diferencia > 0){ ?>
<input type="text" class="form-control input-md" style="width: 200px; background-color: red; color: white;"  value="Descenso de peso: <?php echo $diferencia.' kg'; ?>" readonly>
<?php } ?>
  </div>



</body>
</html>


<script>

  function crearCadenaLineal(json) {

    var parsed = JSON.parse(json);
    var arr = [];

    for(var x in parsed){
      arr.push(parsed[x]);
    }

    return arr;
  }


</script>


<script>


  datosX = crearCadenaLineal('<?php echo $datosX ?>');
  datosY = crearCadenaLineal('<?php echo $datosY ?>');


  var Produccion = {

    x: datosX,

    y: datosY,

    type: 'scatter',

    name: 'Produccion',

    line: {

      shape: 'spline',

      smoothing: 2.3,

      color: 'rgb(255, 98, 157)'

    }


  };



  var layout = {

    title:'Evolucion del Cliente',

    xaxis: {
      title: 'Fechas'
    },

    yaxis: {

      title: 'Peso(KG)'

    }
  };


  var data = [Produccion];


  Plotly.newPlot('graficolineal', data,layout);
</script>


<?php } else {?>

<p>Seleccione cliente para generar graficas</p>

<?php } ?>

<script>
  $(document).ready(function() {

    $('#dato').select2({});
  });
</script>




<?php
} else {
  header("location:../index.php");
}
?>