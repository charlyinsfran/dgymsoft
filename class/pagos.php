<?php 

class pagos{


public function new_pago($datos){
	$c = new conectar();
	$conexion = $c->conexion();
	$sql = "INSERT INTO tb_pagos(nro_pago,tb_clientes,tb_plan,montopagado,fecha_actual,validohasta)
VALUES('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]')";
	return mysqli_query($conexion,$sql);
}


public function anularpago($id){
    $c = new conectar();
    $conexion=$c->conexion();
    $sql = "DELETE FROM tb_pagos where nro_pago = '$id'";
    return mysqli_query($conexion,$sql);
}




}


 ?>