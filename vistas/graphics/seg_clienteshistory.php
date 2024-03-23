
<?php 
require_once "../../class/conexion.php"; 


$c = new conectar();
$conexion=$c->conexion();
if(isset($_GET['dato'])){
$dato = $_GET['dato'];
echo $dato.'dafadf';
}
$sql = "SELECT pesoactual,date(fecha_lastcontrol) FROM tb_fichacliente where tb_clientes = '1001'";
$result = mysqli_query($conexion,$sql);



	$valoresx = array(); //produccion
	$valoresy = array(); //fecha
	


	while ($ver=mysqli_fetch_row($result)) {
		$valoresx[] = $ver[1];
		$valoresy[] = $ver[0];
		
	}

	$datosX = json_encode($valoresx);
	$datosY = json_encode($valoresy);



	?>




	<div id="graficaLineal"></div>
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


		Plotly.newPlot('graficaLineal', data,layout);
	</script>