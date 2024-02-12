<?php

class trainers{

    public function subir_imagen($datos){
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "INSERT INTO tb_photos(nombre,ruta_subida,fecha_subida) values ('$datos[0]','$datos[1]','$datos[2]')";

        $result = mysqli_query($conexion,$sql);

        return mysqli_insert_id($conexion);
        
    }


    public function newtrainer($datos){
        $c = new conectar();
        $conexion = $c->conexion();
        date_default_timezone_set('America/Asuncion');
        $fecha = date('Y-m-d');

        $sql = "INSERT INTO tb_entrenadores(id_entrenadores,nombre,apellido,cedula,formacion,direccion,ciudad,edad,id_tbphoto)
        values ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$datos[7]','$datos[8]')";

        return mysqli_query($conexion,$sql);
    }


    public function obtenerdatos($ide){
        
        $c = new conectar();
        $conexion = $c->conexion();
        $sql = "SELECT id_entrenadores,nombre,apellido,cedula,formacion,direccion,ciudad,edad FROM tb_entrenadores where id_entrenadores = '$ide'";
        $result = mysqli_query($conexion,$sql);

        $ver = mysqli_fetch_row($result);

        $datos = array("id_entrenadores"=>$ver[0],"nombre"=>$ver[1],"apellido"=>$ver[2],"cedula"=>$ver[3],
        "formacion"=>$ver[4],"direccion"=>$ver[5],"ciudad"=>$ver[6],"edad"=>$ver[7]  );


        return $datos;

    }


    public function actualizardatos($datos){

        $c = new conectar();
        $conexion = $c->conexion();
        $sql = "UPDATE tb_entrenadores SET nombre = '$datos[1]',
                                      apellido = '$datos[2]',
                                      cedula = '$datos[3]',
                                      formacion = '$datos[4]',
                                     direccion = '$datos[5]',
                                     ciudad = '$datos[6]',
                                     edad = '$datos[7]'  where id_entrenadores = '$datos[0]'";
       return mysqli_query($conexion,$sql);

    }



    public function eliminar($id){
        $c = new conectar();
        $conexion=$c->conexion();

        $idimagen = self::obtenIdImg($id);
        $sql = "DELETE FROM tb_entrenadores where id_entrenadores= '$id'";
        $result =  mysqli_query($conexion,$sql);

        if($result){
            $ruta = self::obtenRutaImagen($idimagen);
            $sql = "DELETE FROM tb_photos where id_photos = '$idimagen'";
            $result =  mysqli_query($conexion,$sql);

            if($result){
                if(unlink($ruta)){
                    return 1;
                }
            }


        }
    }

/*codigo para obtener datos de imagen */

    public function obtenIdImg($ide){
        $c= new conectar();
        $conexion=$c->conexion();

        $sql="SELECT id_tbphoto
                from tb_entrenadores 
                where id_entrenadores='$ide'";
        $result=mysqli_query($conexion,$sql);

        return mysqli_fetch_row($result)[0];
    }

    public function obtenRutaImagen($idImg){
        $c= new conectar();
        $conexion=$c->conexion();

        $sql="SELECT ruta_subida 
                from tb_photos
                where id_photos='$idImg'";

        $result=mysqli_query($conexion,$sql);

        return mysqli_fetch_row($result)[0];
    }

}


?>