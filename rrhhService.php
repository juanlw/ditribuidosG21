<?php 
	require_once '/vendor/autoload.php';
	require_once '/model/conexionBD.php';
	require_once '/model/personalModelo.php'; 
	require_once ("/controller/personalController.php");
	require_once '/vendor/slim/slim/Slim/App.php';

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$config = [
	    'settings' => [
	        'displayErrorDetails' => true,
	    ],
	];
	
	$appRRHH = new \Slim\App($config);
	
	$appRRHH->post('/loguearse', function ($request, $response, $args) {
		$data = $request->getParsedBody();
		$personalCtrl = new PersonalController();
		$token = $personalCtrl->loguearse($data);
		if ($token == "") {
			$response->withStatus(401);
			return $response;
		} 
		$newResponse = $response->withAddedHeader('Authorization', $token);
		return $newResponse->withStatus(200);
	});	

	$appRRHH->get('/autenticarse', function ($request, $response, $args) {
		$token =  $request->getHeader('Authorization');
		$existe = $personalCtrl->autenticar($token);
		if ($existe) {
			$response->withStatus(200);
		} else {
			$response->withStatus(401);
		}
		return $response;
	});	
		
	$appRRHH->run();
 ?>