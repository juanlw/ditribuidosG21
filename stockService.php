<?php 
	require_once '/vendor/autoload.php';
	require_once '/model/conexionBD.php';
	require_once '/model/productoModelo.php';
	require_once '/model/productTypeModelo.php';
	require_once '/controller/productoController.php';
	require_once '/controller/productTypeController.php';
	require_once '/vendor/slim/slim/Slim/App.php';

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$config = [
	    'settings' => [
	        'displayErrorDetails' => true,
	    ],
	];
	
	$app = new \Slim\App($config);
	
	$app->get('/producto/{id}', function ($request, $response, $args) {
		$token = '';
		if ($request->hasHeader('Authorization')) {
	    	$token =  $request->getHeader('Authorization');
		}	
		$productoCtrl = new ProductoController();
		$producto = $productoCtrl->recuperar($args['id'], $token);
		return $response->withJson($producto, 200);
	});

	$app->get('/producto', function ($request, $response, $args) {
		$token = '';
		if ($request->hasHeader('Authorization')) {
	    	$token =  $request->getHeader('Authorization');
		}
		$productoCtrl = new ProductoController();
		$productos = $productoCtrl->recuperarTodos();
		return $response->withJson($productos, 200);
	});

	$app->get('/productTypes/{typeId}/productos', function ($request, $response, $args) {
		$productoCtrl = new ProductoController();
		$productos = $productoCtrl->recuperarPorProductType($args['typeId']);
		return $response->withJson($productos, 200);
	});
	$app->get('/productos/buscar', function ($request, $response, $args){
		$productoCtrl = new ProductoController();
		$productos = $productoCtrl->buscarPorNombre($request->getParam('nombre'));
		return $response->withJson($productos, 200);
	});
	///product types 
	$app->get('/productTypes', function ($request, $response, $args) {
		$productTypeCtrl = new ProductTypeController();
		$productTypes = $productTypeCtrl->recuperarTodos();
		return $response->withJson($productTypes, 200);
	});	
	$app->get('/productTypes/{id}', function ($request, $response, $args) {
		$productTypeCtrl = new ProductTypeController();
		$productType = $productTypeCtrl->recuperar($args['id']);
		return $response->withJson($productType, 200);
	});

	$app->run();
 ?>