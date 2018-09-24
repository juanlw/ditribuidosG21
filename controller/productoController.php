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
				(int) $venta = $producto['saleprice'];
				(int) $costo = $producto['costprice']; 
				(int) $margen = $venta - $costo;
				(int) $diez = $costo * 0.10;
				if ($producto['producttype']['description'] == 'electro') {
					$producto['precioOnLine'] = $costo + ($margen * 0.5);
				}
				elseif ($margen > ($diez)) {
					(int) $regla = ($venta - ($costo + $diez)) * 0.2;
					$producto['precioOnLine'] = $costo + $diez + $regla; 	
				}
				else{
					$producto['precioOnLine'] = $venta;	
				}
			}
			return $producto;
		}
	}

 ?>