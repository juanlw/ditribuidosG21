<?php 
	/**
	* 
	*/
	class ProductoModelo extends ConexionABD
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function recuperar($id)
		{
			$sql = "SELECT * FROM product AS p WHERE p.id = :unId";
			$consulta = $this->base->prepare($sql);
           	$consulta-> bindParam(':unId', $id, PDO::PARAM_INT);
			$consulta->execute();
         	$producto = $consulta->fetch(PDO::FETCH_ASSOC);
         	$producto['producttype'] = $this->recuperarTipo($producto['producttype']);
            return $producto;
		}

		public function recuperarTipo($id)
		{
			$sql = "SELECT * FROM producttype AS pt WHERE pt.id = :unId";
			$consulta = $this->base->prepare($sql);
           	$consulta-> bindParam(':unId', $id, PDO::PARAM_INT);
			$consulta->execute();
         	$type = $consulta->fetch(PDO::FETCH_ASSOC);
            return $type;
		}
	}

 ?>