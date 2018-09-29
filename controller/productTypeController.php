<?php 
	
	/**
	* 
	*/
	class ProductTypeController
	{
		
		function __construct()
		{
			# code...
		}

		public function recuperar($id)
		{
			$typeModel = new ProductTypeModelo();
			$producType = $typeModel->recuperar($id);
			return $producType;
		}

		public function recuperarTodos()
		{
			$typeModel = new ProductTypeModelo();
			$productTypes = $typeModel->recuperarTodos();
			return $productTypes;
		}

	
	}

 ?>