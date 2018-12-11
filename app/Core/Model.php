<?php
namespace App\Core;

use App\Libs\Database;

class Model{
	public $db;
	protected $tablename;
	public function __construct(){
		$this->db = new Database();
		$this->db->query("SET names UTF8");
	}
}