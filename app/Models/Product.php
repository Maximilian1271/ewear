<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 29/11/2018
 * Time: 21:42
 */

namespace app\Models;


use App\Core\Model;

class Product extends Model{
	protected $table_name = "products";
	public function setProduct($data){

	}
	public function getProduct($name=null){
		if ($name!=null&&is_string($name)){
			$sql="SELECT * FROM {$this->table_name} WHERE title='$name' LIMIT 1";
			$stmt=$this->db->query($sql)->fetch_assoc();
			return $stmt;
		}
		elseif ($name===0){
			$sql="SELECT * FROM {$this->table_name}";
			$stmt=$this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
			return $stmt;
		}
		else return false;
	}
}