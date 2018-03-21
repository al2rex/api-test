<?php

use App\Lib\Auth,
	App\Lib\Response,
	App\Validation\testValidation,
	App\Middleware\AuthMiddleware;

$app->group('/users/', function () {
	$this->get('', function($req, $res, $args){
		return $res->widthHeader('Content-type', 'text/html')
				   ->write('Soy una ruta de prueba');
	});

	$this->get('empleado/listar/{a}/{p}', function($req, $res, $args){
		return $res->widthHeader('Content-type', 'application/json')
				   ->write(json_encode($this->model->test->getAll($args['a'], $args['p'])));
	});

	$this->get('empleado/registrar', function($req, $res, $args){
		return $res->widthHeader('Content-type', 'application/json')
				   ->write(json_encode($this->model->test->insert($reg->getParsedBody())));
	});
	
	$this->get('valido', function($req, $res, $args){
		$r = testValidation::validate($req->getParsedBody());

		if(!$r->Response){
			return $res->widthHeader('Content-type', 'application/json')
				   ->withStatus(422)
				   ->write(json_encode($r->errors));
		}
		return $res->widthHeader('Content-type', 'application/json')
				   ->write(json_encode($this->model->test->getAll()));
	}); 

	$this->get('auth', function($req, $res, $args){
		$token = Auth::SignIn([
			'Nombre' => 'Arnaldo',
			'Correo' => 'arnaldo.castilla@hotmail.com',
			'Imagen' => null
			]);
		$res->write($token);
	});

	$this->get('auth/validate', function($req, $res, $args){
		$res->write('OK');
	})->add(new AuthMiddleware($this));

});