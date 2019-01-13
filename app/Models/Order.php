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

	public function placeOrder($address){
		$time=time();
		$user_fs=Sessions::get('id');
		$cart=new Cart();
		$cart=$cart->getCart();
		$cart=$cart['data'];
		$stmt=$this->db->prepare("INSERT INTO {$this->table_name} (cart_data, user_fs, address, created_at) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("sisi", $cart, $user_fs, $address, $time);
		return $stmt->execute();
	}
	public function getOrders(){
		return $this->db->query("SELECT * FROM {$this->table_name}")->fetch_all();
	}
}