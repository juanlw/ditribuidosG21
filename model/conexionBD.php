<?php 
	/**
	* requerir en el controlador que se crea un modelo
	*/
	
	abstract class ConexionABD
	{
		const USERNAME = "grupo63";
    const PASSWORD = "ZTJhNTVlODlhMDk0";
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