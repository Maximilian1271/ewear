<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 13/12/2018
 * Time: 15:51
 */

namespace App\Models;


use App\Core\Model;
use App\Libs\Sessions;

class Order extends Model
{
	protected $table_name="orders";

	public function placeOrder(){
		$time=time();
		$cart=new Cart();
		$cart=$cart->getCart();
		$cart=$cart['data'];
		$stmt=$this->db->prepare("INSERT INTO {$this->table_name} (cart_data, user_fs, created_at) VALUES (?, ?, ?)");
		$stmt->bind_param("sii", $cart, Sessions::get('id'), $time);
		$stmt->execute();
	}
}