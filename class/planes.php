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


 public function bringdata($ide){
        
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "SELECT idtb_plan,descripcion,id_moneda,ROUND(costo),cant_clases FROM tb_plan WHERE idtb_plan = '$ide'";
        $result = mysqli_query($conexion,$sql);

        $ver = mysqli_fetch_row($result);

        $datos = array("idtb_plan"=>$ver[0],"descripcion"=>$ver[1],"id_moneda"=>$ver[2],"costo"=>$ver[3],"cant_clases"=>$ver[4]);


        return $datos;
    }



        
    }
?>