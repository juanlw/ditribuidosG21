<?php 
	/**
	* 
	*/
	class ProductoModelo extends ConexionABD
	{
		
		function __construct()
		{
			parent::__construct("inudev17_stock");
		}

		public function recuperar($id)
		{
			$sql = "SELECT * FROM product AS p WHERE p.id = :unId";
			$consulta = $this->base->prepare($sql);
           	$consulta-> bindParam(':unId', $id, PDO::PARAM_INT);
			$consulta->execute();
         	$producto = $consulta->fetch(PDO::FETCH_ASSOC);
         	if ($producto){
                $producto['producttype'] = $this->recuperarTipo($producto['producttype']);
            }
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

		public function recuperarTodos()
		{
			$sql = "SELECT * FROM product";
			$consulta = $this->base->prepare($sql);
			$consulta->execute();
         	$productos = $consulta->fetchAll(PDO::FETCH_ASSOC);
         	$productosCopy = array();
         	foreach ($productos as $prod) {
         		$prod['producttype'] = $this->recuperarTipo($prod['producttype']);
         		$productosCopy[] = $prod;
         	}
            return $productosCopy;
		}

		public function recuperarPorProductType($typeId){
			$sql = "SELECT * FROM product AS p WHERE p.producttype = :typeId";
			$consulta = $this->base->prepare($sql);
			$consulta->bindParam(':typeId', $typeId, PDO::PARAM_INT);
			$consulta->execute();
			$productos = $consulta->fetchAll(PDO::FETCH_ASSOC);
			
			$productType = $this->recuperarTipo($typeId);
			$productosCopy = array();
         	foreach ($productos as $prod) {
         		$prod['producttype'] = $productType;
         		$productosCopy[] = $prod;
         	}
            return $productosCopy;
		}
		
		public function buscarPorNombre($nombre){
			$sql = "SELECT * FROM product AS p WHERE  p.name LIKE  :nombre";
			$consulta = $this->base->prepare($sql);
			$nombre = "%".$nombre."%";
			$consulta->bindParam(':nombre', $nombre, PDO::PARAM_STR);
			$consulta->execute();
			$productos = $consulta->fetchAll(PDO::FETCH_ASSOC);
			
			$productosCopy = array();
         	foreach ($productos as $prod) {
         		$prod['producttype'] = $this->recuperarTipo($prod['producttype']);
         		$productosCopy[] = $prod;
         	}
            return $productosCopy;
		}

		public function comprar($id){

			$sql = "UPDATE product SET stock = stock - 1 WHERE id = :unId AND stock > 0";
			$consulta = $this->base->prepare($sql);
			$consulta-> bindParam(':unId', $id, PDO::PARAM_INT);
			$consulta->execute();
			return $consulta->rowCount() > 0;
		}
	}

 ?>