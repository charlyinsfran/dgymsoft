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
}


?>