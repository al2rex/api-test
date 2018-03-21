<?php

namespace App\Model;

use App\Lib\Response;
	
class ContactoModel{

	private $db;
	private $table = 'contacto';
	private $response;

	public function __construct($db){
		$this->db = $db;
		$this->response = new Response();
	}

	public function listar(){

		$data = $this->db->from($this->table)
						 ->fetchAll();

		return [
			'data' => $data
		];				  
	}
}