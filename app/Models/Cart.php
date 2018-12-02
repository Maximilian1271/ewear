<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 02/12/2018
 * Time: 23:45
 */

namespace app\Models;


use App\Core\Model;

class Cart extends Model{
	protected $table_name="cart";
	public function getCartById($id){
		return $this->db->query("SELECT * FROM {$this->table_name} WHERE user_fs=$id")->fetch_assoc();
	}
}