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

		public function recuperarTodos()
		{
			$sql = "SELECT * FROM employee";
			$consulta = $this->base->prepare($sql);
			$consulta->execute();
			$personas = $consulta->fetchAll(PDO::FETCH_ASSOC);
			return $personas;
		}

		public function recuperar($id)
		{
			$sql = "SELECT * FROM employee AS p WHERE p.id = :unId";
			$consulta = $this->base->prepare($sql);
			$consulta-> bindParam(':unId', $id, PDO::PARAM_INT);
			$consulta->execute();
			$persona = $consulta->fetch(PDO::FETCH_ASSOC);
			$persona['employeetype'] = $this->recuperarTipo($persona['employeetype']);
			return $persona;
		}

		private function recuperarTipo($employeetype)
		{
			$sql = "SELECT * FROM employeetype AS pt WHERE pt.id = :unId";
			$consulta = $this->base->prepare($sql);
			$consulta-> bindParam(':unId', $employeetype, PDO::PARAM_INT);
			$consulta->execute();
			$type = $consulta->fetch(PDO::FETCH_ASSOC);
			return $type;
		}
	}

 ?>