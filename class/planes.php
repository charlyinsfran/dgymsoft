<?php

class planes{
    public function addplan($datos){
        $c = new conectar();
        $conexion = $c->conexion();


        $sql = "INSERT INTO tb_plan(descripcion,id_moneda,costo,cant_clases) values ('$datos[0]','$datos[1]','$datos[2]','$datos[3]')";

        return mysqli_query($conexion,$sql);


    }


public function actualizarCategorias($datos){
    

		$c = new conectar();
		$conexion=$c->conexion();

		$sql = "UPDATE categorias SET nombreCategoria = '$datos[1]' WHERE id_categoria = '$datos[0]'";

		echo mysqli_query($conexion,$sql);
	
	
}


public function eliminaCategoria($idca){
    $c = new conectar();
    $conexion=$c->conexion();
    $sql = "DELETE FROM categorias where id_categoria = '$idca'";
    return mysqli_query($conexion,$sql);
}



        
    }
?>