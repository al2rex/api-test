<?php

namespace App\Model;

use App\Lib\Response;

class ProductoModel{
	private $db;
	private $table = 'producto';
	private $response;

	public function __construct($db){
		$this->db = $db;
		$this->reponse = new Response();
	}

	public function getAll($a, $p){

		$data = $this->db->from($this->table)
						 ->limit($a)
						 ->offset($p)
						 ->orderBy('id DESC')
						 ->fetchAll();

		$total = $this->db->from($this->table)
						  ->select('COUNT(*) Total')
						  ->fetch()
						  ->Total;
		return [
			'data' => $data,
			'total' => $total
		];				  
	}

	public function insert($data){
		$data['Password']= md5($data['Password']);

		$this->db->insertInto($this->table, $data)
				->execute();

		return $this->response->SetResponse(true);
	}
}