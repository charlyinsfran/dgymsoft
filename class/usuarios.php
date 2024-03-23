<?php 

class usuarios{

	public function loginUser($datos){

		$c = new conectar();
		$conexion=$c->conexion();
		$pass = sha1($datos[1]);

		$_SESSION['usuario'] = $datos[0];
		
		$_SESSION['iduser'] = SELF::traeID($datos);
		$_SESSION['tipousuario'] = SELF::traetipousuario($datos);


		$sql = "SELECT * FROM tb_users WHERE usuario = '$datos[0]' AND password = '$pass'";

		$result = mysqli_query($conexion,$sql);

		if(mysqli_num_rows($result) > 0){
			return 1;
		}else{
			return 0;
		}

	}



	public function traeID($datos){
		$c = new conectar();
		$conexion=$c->conexion();
		$pass = sha1($datos[1]);


		$sql = "SELECT idtb_users FROM tb_users WHERE usuario = '$datos[0]' AND password = '$pass'";

		$result = mysqli_query($conexion,$sql);

		return mysqli_fetch_row($result)[0]; 
	}

	public function traetipousuario($datos){
		$c = new conectar();
		$conexion=$c->conexion();
		$pass = sha1($datos[1]);

		$sql = "SELECT r.descripcion FROM tb_users u JOIN tb_rol r ON r.idtb_rol = u.tb_roll 
		where u.usuario = '$datos[0]' AND u.password = '$pass'";

		$result = mysqli_query($conexion,$sql);

		return mysqli_fetch_row($result)[0]; 
	}



	public function new_usuario($datos){
		$c = new conectar();
		$conexion=$c->conexion();

		$sql = "INSERT into tb_users(idtb_users,nombre,apellido,email,telefono,usuario,password,tb_roll) 
		values ('$datos[0]',
			'$datos[1]',
			'$datos[2]',
			'$datos[3]',
			'$datos[4]',
			'$datos[5]',
			'$datos[6]',
			'$datos[7]')";

		return mysqli_query($conexion,$sql);
	}

public function obtenerdatos($ide){
	$c = new conectar();
	$conexion = $c->conexion();
	$sql = "SELECT idtb_users,nombre,apellido,email,telefono,usuario,tb_roll from tb_users 
	WHERE idtb_users = '$ide'";
	$result = mysqli_query($conexion,$sql);

	$ver = mysqli_fetch_row($result);

	$datos = array("idtb_users"=>$ver[0],"nombre"=>$ver[1],"apellido"=>$ver[2],"email"=>$ver[3],
	"telefono"=>$ver[4],"usuario"=>$ver[5],"id_rol"=>$ver[6]);


	return $datos;
}

public function actualizarusuarios($datos){

	$c = new conectar();
	$conexion = $c->conexion();
	$sql = "UPDATE tb_users SET nombre = '$datos[1]',
								apellido = '$datos[2]',
									email = '$datos[3]',
									telefono = '$datos[4]',
									usuario = '$datos[5]',
									tb_roll = '$datos[6]'
									 where idtb_users = '$datos[0]'";
   return mysqli_query($conexion,$sql);

}

public function eliminausuario($id){
	$c = new conectar();
	$conexion=$c->conexion();
	$sql = "DELETE FROM tb_users where idtb_users = '$id'";
	return mysqli_query($conexion,$sql);

	
}


}


?>