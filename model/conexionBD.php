<?php 
	/**
	* requerir en el controlador que se crea un modelo
	*/
	
	abstract class ConexionABD
	{
		const USERNAME = "grupo63";
    const PASSWORD = "ZTJhNTVlODlhMDk0";
		const HOST ="localhost";
		const DB = "supermercado";
		var $base;	

		function __construct()
		{	
			    $u=self::USERNAME;
        	$p=self::PASSWORD;
        	$db=self::DB;
        	$host=self::HOST;
        	$this->base = new PDO("mysql:dbname=$db;host=$host", $u, $p);
        	$this->base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		
		public static function darConexion()
		{
			$u=self::USERNAME;
        	$p=self::PASSWORD;
        	$db=self::DB;
        	$host=self::HOST;
        	$connection = new PDO("mysql:dbname=$db;host=$host", $u, $p);
        	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        	return $connection;
		}
	}
 ?>