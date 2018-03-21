<?php

namespace App\Validation;

use App\Lib\Response;

class EmpleadoValidation{
	public static function validate($data, $update = false){
		$response = new Response();


		$key = 'esAdmin';
		if(!isset($data[$key])){
			$response->errors[$key][] = 'Este campo es obligatorio';
		}else{
			$value = $data[$key];
			if($value != '1' && $value != '2'){
				$response->errors[$key][] = 'Puede tomar 1 ó 0';
			}
		}

		$key = 'Nombre';
		if(empty($data[$key])){
			$response->errors[$key][] = 'Este campo es obligatorio';
		}else{
			$value = $data[$key];
			if(strlen($value) < 4){
				$response->errors[$key][] = 'Debe contener como minimo 4 caracteres';
			}
		}

		$key = 'Correo';
		if(empty($data[$key])){
			$response->errors[$key][] = 'Este campo es obligatorio';
		}else{
			$value = $data[$key];
			if( !filter_var($value, FILTER_VALIDATE_EMAIL )){
				$response->errors[$key][] = 'valor ingresado no es un correo valido';
			}
		}

		$key = 'Password';
		if(!$update){
			if(empty($data[$key])){
				$response->errors[$key][] = 'Este campo es obligatorio';
			}else{
				$value = $data[$key];
				if(strlen($value) < 4){
					$response->errors[$key][] = 'Debe contener como minimo 4 caracteres';
				}
			}
		}else{
			if(!empty($data[$key])){
				$value = $data[$key];
				if(strlen($value) < 4){
					$response->errors[$key][] = 'Debe contener como minimo 4 caracteres';
				}
			}
		}
		
		$response->SetResponse(count($response->errors) === 0);
		
		return $response;
	}
}