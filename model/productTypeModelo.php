<?php 
	/**
	* 
	*/
	class ProductTypeModelo extends ConexionABD
	{
		
		function __construct()
		{
			parent::__construct("stock");
		}
		public function recuperar($id)
		{
			$sql = "SELECT * FROM producttype AS pt WHERE pt.id = :unId";
			$consulta = $this->base->prepare($sql);
           	$consulta-> bindParam(':unId', $id, PDO::PARAM_INT);
			$consulta->execute();
         	$type = $consulta->fetch(PDO::FETCH_ASSOC);
            return $type;
		}
		public function recuperarTodos()
		{
			$sql = "SELECT * FROM producttype";
			$consulta = $this->base->prepare($sql);
			$consulta->execute();
         	$productTypes = $consulta->fetchAll(PDO::FETCH_ASSOC);
         	
            return $productTypes;
		}
		public function recuperarPorProductType($typeId){
			$sql = "SELECT * FROM product AS p WHERE p.producttype = :typeId";
			$consulta = $this->base->prepare($sql);
			$consulta->bindParam(':typeId', $typeId, PDO::PARAM_INT);
			$consulta->execute();
			$productos = $consulta->fetch(PDO::FETCH_ASSOC);
			return $productos;
		}
		public function buscarPorNombre($nombre){
			$sql = "SELECT * FROM product AS p WHERE  p.name LIKE  :nombre";
			$consulta = $this->base->prepare($sql);
			$nombre = "%".$nombre."%";
			$consulta->bindParam(':nombre', $nombre, PDO::PARAM_STR);
			$consulta->execute();
			$productos = $consulta->fetch(PDEO::FETCH_ASSOC);
		}
	}
 ?>