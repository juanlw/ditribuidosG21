<?php 
	
	/**
	* 
	*/
	class ProductoController
	{
		
		function __construct()
		{
			# code...
		}

		public function recuperar($id)
		{
			$productoM = new ProductoModelo();
			$producto = $productoM->recuperar($id);
			if (!is_null($producto)) {
				$producto['precioOnLine'] =  $this->calcularOnline($producto);
			}
			return $producto;
		}

		public function recuperarTodos()
		{
			$productoM = new ProductoModelo();
			$productos = $productoM->recuperarTodos();
			$productosCopy = array();
			foreach ($productos as $prod) {
				$prod['precioOnLine'] =  $this->calcularOnline($prod);
				$productosCopy[] = $prod;
			}
			return $productosCopy;
		}

		private function calcularOnline($producto)
		{
			(int) $venta = $producto['saleprice'];
			(int) $costo = $producto['costprice']; 
			(int) $margen = $venta - $costo;
			(int) $diez = $costo * 0.10;
			$online = $venta;
			if ($producto['producttype']['description'] == 'electro') {
				$online = $costo + ($margen * 0.5);
			}
			elseif ($margen > ($diez)) {
				(int) $regla = ($venta - ($costo + $diez)) * 0.2;
				$online = $costo + $diez + $regla; 	
			}
			else{
				$online = $venta;	
			}
			return $online;
		}
	}

 ?>