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

		public function recuperar($id, $empleado)
		{
			$productoM = new ProductoModelo();
			$producto = $productoM->recuperar($id);
			if ($producto) {
				if ($empleado) {
					if ($this->auntentificar($empleado)) {
						$producto['precioOnLine'] = $producto['costprice'];
					}
					
				}
				else{
					//$producto['precioOnLine'] =  $this->calcularOnline($producto);
				}
			}
			return $producto;
		}

		public function recuperarTodos()
		{
			$productoM = new ProductoModelo();
			$productos = $productoM->recuperarTodos();
			$productosCopy = array();
			foreach ($productos as $prod) {
				//$prod['precioOnLine'] =  $this->calcularOnline($prod);
				$productosCopy[] = $prod;
			}
			return $productosCopy;
		}

		/*private function calcularOnline($producto)
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
		}*/

		public function auntentificar($token)
		{	
			//$headers = array("Authorization: $token");
			$ch = curl_init('localhost/distribuidos/rrhhService.php/autenticarse');
	    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . $token));
			$respuesta = curl_exec($ch);
			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
			curl_close($ch);
			return $http_code == 200;
			/*return true;*/
		}

		public function recuperarPorProductType($tipeId){
			$productoM = new ProductoModelo();
			$productos = $productoM->recuperarPorProductType($tipeId);
			$productosCopy = array();
			foreach ($productos as $prod) {
				//$prod['precioOnLine'] =  $this->calcularOnline($prod);
				$productosCopy[] = $prod;
			}
			return $productosCopy;
		}
		
		public function buscarporNombre($nombre){
			$productoM = new ProductoModelo();
			$productos = $productoM->buscarPorNombre($nombre);
			$productosCopy = array();
			foreach ($productos as $prod) {
				//$prod['precioOnLine'] =  $this->calcularOnline($prod);
				$productosCopy[] = $prod;
			}
			return $productosCopy;
		}

		public function comprar($producto)
		{
			$productoM = new ProductoModelo();
			return $productoM->comprar($producto['id']);
		}
	}

 ?>