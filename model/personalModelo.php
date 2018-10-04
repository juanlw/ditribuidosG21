<?php 
	/**
	* 
	*/
	class PersonalModelo extends ConexionABD
	{
		
		function __construct()
		{
			parent::__construct("rrhh");
		}


		public function loguearse($data)
		{
			$sql = "SELECT firstname, surname, email FROM employee WHERE email = :unCorreo and password = :unPass";
			$consulta = $this->base->prepare($sql);
			$consulta-> bindParam(':unCorreo', $data['mail'], PDO::PARAM_STR, 50);
			$consulta-> bindParam(':unPass', $data['contrasena'], PDO::PARAM_STR, 50 );
			$consulta->execute();//(array($user));
			$usuario = $consulta-> fetch();
			return $usuario;
		}

		public function autenticar($data)
		{
			$sql = "SELECT * FROM employee WHERE email = :unCorreo and surname = :unApellido AND firstname = :unNombre";
			$consulta = $this->base->prepare($sql);
			$consulta-> bindParam(':unCorreo', $data['email'], PDO::PARAM_STR, 50);
			$consulta-> bindParam(':unApellido', $data['surname'], PDO::PARAM_STR, 50 );
			$consulta-> bindParam(':unNombre', $data['firstname'], PDO::PARAM_STR, 50 );
			$consulta->execute();//(array($user));
			$usuario = $consulta-> fetch();
			return !is_null($usuario);
		}
	}

 ?>