<?php 
	/**
	* requerir en el controlador que se crea un modelo
	*/
	
	abstract class ConexionABD
	{
		const USERNAME = "inudev17_dssd";
		const PASSWORD = "dssd1";
		const HOST ="localhost";
		var $base;	

		function __construct($db)
		{	
			$u=self::USERNAME;
        	$p=self::PASSWORD;
        	$host=self::HOST;
        	$this->base = new PDO("mysql:dbname=$db;host=$host", $u, $p);
        	$this->base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}	
	}
 ?>