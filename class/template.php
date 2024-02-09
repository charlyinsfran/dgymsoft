<?php

class nombre{


public function new_($datos){

    $c = new conectar();
    $conexion = $c->conexion();

    $sql = "INSERT INTO tabla (campos) VALUES('$datos[x]')";

        return mysqli_query($conexion,$sql);
    }



    public function obtenerdatos($ide){
        $c = new conectar();
        $conexion = $c->conexion();
        $sql = "SELECT campos FROM tabla WHERE idtabla = '$ide'";
        $result = mysqli_query($conexion,$sql);

        $ver = mysqli_fetch_row($result);

        $datos = array("campo"=>$ver[x]);


        return $datos;
    }


    public function update_($datos){

        $c = new conectar();
        $conexion = $c->conexion();
        $sql = "UPDATE tabla SET variable = '$datos[x]'";
       return mysqli_query($conexion,$sql);

    }


    public function remove_($id){
        $c = new conectar();
        $conexion=$c->conexion();
        $sql = "DELETE FROM tabla where idtabbla = '$id'";
        return mysqli_query($conexion,$sql);

        
    }



}


?>