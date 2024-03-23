<?php 
error_reporting(0);
session_start();

$nombrecliente = "";
$apellidocliente = "";
$cedula = "";
$peso = "";
$altura = "";
$imc = "";


if(isset($_SESSION['usuario'])){ 

	if(isset($_SESSION['cliente_gym'])){
		$validacion = $_SESSION['cliente_gym']->imc;

		$nombrecliente = $_SESSION['cliente_gym']->nombre;
		$apellidocliente =  $_SESSION['cliente_gym']->apellido;
		$cedula =  $_SESSION['cliente_gym']->cedula;
		$peso =  $_SESSION['cliente_gym']->peso;
		$altura =  $_SESSION['cliente_gym']->altura;
		if($validacion > 25.00){
			$imc =  $_SESSION['cliente_gym']->imc;
		}else{
			$imc = $_SESSION['cliente_gym']->imc;
		}
		

	}else{
		$nombrecliente = "";
		$apellidocliente = "";
		$cedula = "";
		$peso = "";
		$altura = "";

	}

	?>


	<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="../pictures/iconos/metodo-de-pago.png">
		<title>Pagos</title>
		<?php 
		require_once "menu.php";

		?>

	</head>
	<br>
	<br><br>
	<body>
		<div class="container">
			<div class="row">

				<div class="col-sm-8">

					<form id="frm_consulta" action="models/model_fichacliente.php" method="POST">
						
						<br>
						<label>Buscar Cliente</label>
						<input type="text" class="form-control input-md" id="dato" name="dato" style="width: 150px; ">
						<p></p>
						<?php if(isset($_SESSION['cliente_gym'])){

							?>
							<button class="btn btn-md btn-danger" id="eliminarclienteselect" value="eliminarclienteselect" name="operacion" style="position: absolute;top: 9.8%; left: 22%;">Anular</button>
						<?php } else {?>	
							<button class="btn btn-md btn-primary" id="agregar_cliente" value="agregar_cliente" name="operacion" style="position: absolute;top: 9.8%; left: 22%;">Buscar</button>
						<?php } ?>

						<p></p>
						<br>

						<table class="table table-bordered table-fixed">
							<tr align="center" >
								<th style="text-align: center;">Cliente</th>
								<th style="text-align: center;">C.I</th>
								<th style="text-align: center;">Peso Inicial</th>
								<th style="text-align: center;">IMC Inicial</th>
							</tr>

							<tr>
								<td><input type="text" class="form-control" style="text-align: center;" value="<?php echo $nombrecliente.' '.$apellidocliente; ?>" readonly>
								</td>
								<td><input type="text" class="form-control" style="text-align: center;" 
									value="<?php if(!empty($cedula)){echo number_format($cedula, 0, ",", ".");} else {echo $cedula;} ?>" readonly></td>
									<td><input type="text" class="form-control" style="text-align: center;" value="<?php echo $peso; ?>" id="peso" name="peso" readonly></td>
									<td><input type="text" class="form-control" style="text-align: center; font-weight: bold;" id="imc_input" name="imc_input" value="<?php echo $imc;?>" readonly></td>
								</tr>

							</table>


							<br>
							

							<table class="table table-bordered table-fixed">
								<tr>
									<th>Peso Actual</th>
									<th>Diferencia</th>

								</tr>
								<tr>
									<td><input type="text" class="form-control" id="pesoactual" name="pesoactual"
										onKeyUp="pierdeFoco(this); restar();"></td>
										<td><input type="text" class="form-control" id="diferencia" name="diferencia" readonly></td>
									</tr>
								</table>


								<table class="table table-bordered table-fixed">
									<tr>
										<th>Periodo Control</th>
										<th>Ultimo Control</th>

									</tr>
									<tr>
										<td style="width: 50%;">
											<select class="js-example-responsive" style="width: 50%; height: 30%;" name="periodo" id="periodo">
												<option value="A">Seleccione periodo:</option>
												<option value="Quincenal">Quincenal</option>
												<option value="Mensual">Mensual</option>
												<option value="Trimestral">Trimestral</option>
												<option value="Semestral">Semestral</option>

											</select></td>
											<td><input type="date" class="form-control" style="width: 55%;" id="fecha_lastcontrol" name="fecha_lastcontrol"></td>
										</tr>
									</table>
									
									<?php if(isset($_SESSION['cliente_gym'])){?>
									<button class="btn btn-md btn-success" id="" value="guardar" name="operacion" style="position: absolute;top: 100%; left: 2%; width: 15%; height: 10%;">Guardar</button>
									
									<button class="btn btn-md btn-danger" id="" value="anular" name="operacion" style="position: absolute;top: 100%; left: 18%; width: 15%; height: 10%;">Cancelar</button>
								<?php } ?>

								</form>
							</div>
							<div class="col-sm-6">
								<div id="tablaCargosLoad"></div>
							</div>

						</div>

					</div>



				</body>
				</html>

				<script>
					$(document).ready(function() {


						$('#periodo').select2({
						});


					});
				</script>

				<script>



					function pierdeFoco(e){
    		var valor = e.value.replace(/^0*/, '');
						e.value = valor;
					}


					function restar() {
						var peso_actual = document.getElementById('pesoactual').value;
						var peso_inicial = document.getElementById('peso').value;

						if(peso_actual > 0){
							var resultado = peso_actual - peso_inicial;
						}
						document.getElementById('diferencia').value = resultado.toFixed(2);



					}
				</script>




				<?php 


				switch ($_GET['error']) {

					case 1:
					echo '<script language="Javascript">
					$("#dato").focus();
					alertify.alert("Debe ingresar cedula del cliente");
					</script>';

					break;
					case 2:

					echo '<script language="Javascript">
					$("#dato").focus();
					alertify.error("No existe cliente en la base de datos");
					</script>';

					break;


				}



				switch ($_GET['aviso']) {
					case 1:
					echo '<script language="Javascript">
					alertify.success("Cliente Seleccionado");
					$("#pesoactual").focus();
					</script>';

					break;

					case 3:
					echo '<script language="Javascript">
					$("#dato").focus();
					alertify.alert("Cliente Inhabilitado");
					
					</script>';

					break;
				}
			} else {
				header("location:../index.php");
			}
			?>




