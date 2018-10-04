<?php 
	require_once 'utils/jwt.php';
	/**
	* 
	*/
	class PersonalController
	{
		
		function __construct()
		{
			# code...
		}

		public function loguearse($data)
		{
			$personalM = new PersonalModelo();
			$empleado = $personalM->loguearse($data);
			$token = "";
			if ($empleado) {
				$jwt = new JsonWebToken();
				$token = $jwt->serializar($empleado);
			}
			return $token;
		}

		public function autenticar($token)
		{
			$jwt = new JsonWebToken();
			$empleado = $jwt->deserializar($token);
			$personalM = new PersonalModelo();
			return $personalM->autenticar($token); 
		}

	}

 ?>