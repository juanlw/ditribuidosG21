<?php 
	use \Firebase\JWT\JWT;

	/**
	* 
	*/
	class JsonWebToken
	{
		const SecretKey = "Grupo21";

		function __construct()
		{

		}

		public function serializar($obj)
		{
			$jwt = JWT::encode($obj, self::SecretKey);
			return $jwt;
		}

		public function deserializar($string)
		{
			JWT::$leeway = 190;
			$decoded = JWT::decode($string, self::SecretKey, array('HS256'));
			return (array) $decoded;;
		}

	}

 ?>