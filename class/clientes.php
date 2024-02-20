<?php 

class clientes {
	public function subir_imagen($datos){
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "INSERT INTO tb_photos(nombre,ruta_subida,fecha_subida) values ('$datos[0]','$datos[1]','$datos[2]')";

        $result = mysqli_query($conexion,$sql);

        return mysqli_insert_id($conexion);
        
    }


    public function newcliente($datos){
        $c = new conectar();
        $conexion = $c->conexion();

        date_default_timezone_set('America/Asuncion');
        $fecha = date('Y-m-d');

        $sql = "INSERT INTO tb_clientes(id_clientes,nombre,apellido,cedula,ocupacion,fecha_nac,email,tb_ciudades,telefono,direccion,altura,peso,imc,estado,tb_photos)
						VALUES('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$datos[7]','$datos[8]','$datos[9]','$datos[10]',
							'$datos[11]','$datos[12]','ACTIVO','$datos[13]')";

        return mysqli_query($conexion,$sql);
    }

public function obtenerdatos($ide){
        
        $c = new conectar();
        $conexion = $c->conexion();
        $sql = "SELECT id_clientes,nombre,apellido,cedula,ocupacion,fecha_nac,email,tb_ciudades,telefono,direccion,altura,peso,imc FROM tb_clientes where id_clientes = '$ide'";
        $result = mysqli_query($conexion,$sql);

        $ver = mysqli_fetch_row($result);

        $datos = array("id_clientes"=>$ver[0],"nombre"=>$ver[1],"apellido"=>$ver[2],"cedula"=>$ver[3],
        "ocupacion"=>$ver[4],"fecha_nac"=>$ver[5],"email"=>$ver[6],"tb_ciudades"=>$ver[7],"telefono"=>$ver[8],"direccion"=>$ver[9],"altura"=>$ver[10],"peso"=>$ver[11],
        "imc"=>$ver[12]);


        return $datos;

    }

public function actualizardatos($datos){

        $c = new conectar();
        $conexion = $c->conexion();
        $sql = "UPDATE tb_clientes 
        SET nombre = '$datos[1]',apellido = '$datos[2]',cedula = '$datos[3]',ocupacion = '$datos[4]',
            fecha_nac = '$datos[5]',email = '$datos[6]',tb_ciudades = '$datos[9]',telefono = '$datos[7]',
            direccion = '$datos[8]',altura = '$datos[11]',peso = '$datos[10]',imc = '$datos[12]'  where id_clientes = '$datos[0]'";
       return mysqli_query($conexion,$sql);

    }


}




 ?>