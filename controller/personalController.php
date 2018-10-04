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
			return $personalM->autenticar($empleado); 
		}

		public function recuperarTodos(){
			$personaM = new PersonalModelo();
			$personas = $personaM->recuperarTodos();
			return $personas;
		}

		public function recuperar($id)
		{
			$personaM = new PersonalModelo();
			$personas = $personaM->recuperar($id);
			return $personas;
		}

		public function recuperarTodosEmployeeType()
		{
			$personaM = new PersonalModelo();
			$employeeTypes = $personaM->recuperarTodosEmployeeType();
			return $employeeTypes;
		}

		public function recuperarEmployeeType($id)
		{
			$personaM = new PersonalModelo();
			$employeeTypes = $personaM->recuperarTipo($id);
			return $employeeTypes;
		}

	}

 ?>