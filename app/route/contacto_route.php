<?php

use App\Lib\Auth,
	App\Lib\Response;

$app->group('/contacto/', function () {
	
	$this->get('listar', function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->contacto->listar())
				   	);
	});

});