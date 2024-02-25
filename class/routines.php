<?php 

class routines{

public function addroutine($datos){

	$c = new conectar();
	$conexion = $c->conexion();

	$sql = "INSERT INTO tb_rutina(id_rutina,descripcion,calentamiento,tiempo,
								ejercicio1,repeticiones1,ejercicio2,repeticiones2,
								ejercicio3,repeticiones3,descanso)
			 VALUES('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]',
			 	'$datos[7]','$datos[8]','$datos[9]','$datos[10]')";
	return mysqli_query($conexion,$sql);

}




public function obtenerdatos($ide){
        
        $c = new conectar();
        $conexion = $c->conexion();
        $sql = "SELECT id_rutina,descripcion,calentamiento,tiempo,
								ejercicio1,repeticiones1,ejercicio2,repeticiones2,
								ejercicio3,repeticiones3,LEFT(descanso,1) FROM tb_rutina where id_rutina = '$ide'";
        $result = mysqli_query($conexion,$sql);

        $ver = mysqli_fetch_row($result);

        $datos = array("id_rutina"=>$ver[0],"descripcion"=>$ver[1],"calentamiento"=>$ver[2],"tiempo"=>$ver[3],
        "ejercicio1"=>$ver[4],"repeticiones1"=>$ver[5],"ejercicio2"=>$ver[6],"repeticiones2"=>$ver[7],"ejercicio3"=>$ver[8],"repeticiones3"=>$ver[9],"descanso"=>$ver[10]);


        return $datos;

    }


  public function updateroutine($datos){

        $c = new conectar();
        $conexion = $c->conexion();
        $sql = "UPDATE tb_rutina 
        		SET descripcion = '$datos[1]',calentamiento = '$datos[2]',tiempo = '$datos[3]',
								ejercicio1 = '$datos[4]', repeticiones1 = '$datos[5]',ejercicio2 = '$datos[6]',repeticiones2 = '$datos[7]',
								ejercicio3 = '$datos[8]',repeticiones3 = '$datos[9]',descanso = '$datos[10]'  where id_rutina = '$datos[0]'";
       return mysqli_query($conexion,$sql);

    }


 public function deleteroutine($id){
    $c = new conectar();
    $conexion=$c->conexion();
    
    $sql = "DELETE FROM tb_rutina where id_rutina = '$id'";

    return mysqli_query($conexion,$sql);
}




}




 ?>