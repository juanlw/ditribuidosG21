<?php 
	require_once '/vendor/autoload.php';
	require_once '/model/conexionBD.php';
	require_once '/model/productoModelo.php'; 
	require_once ("/controller/productoController.php");
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
	   	//$response->withStatus(200);
		//$res->setBody(json_encode($meses));
		$productoCtrl = new ProductoController();
		$producto = $productoCtrl->recuperar($args['id']);
		return $response->withJson($producto, 200);
	});	
	$app->run();
 ?>
