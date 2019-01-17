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
	public function getOrders($id){
		if(isset($id)){
			return $this->db->query("SELECT orders.*,orderstatus.StatusName FROM {$this->table_name} LEFT JOIN orderstatus ON orders.status=orderstatus.status_fs WHERE orders.user_fs=$id")->fetch_all(MYSQLI_ASSOC);
		}else return $this->db->query("SELECT orders.*,orderstatus.StatusName FROM {$this->table_name} LEFT JOIN orderstatus ON orders.status=orderstatus.status_fs")->fetch_all();
	}
	public function getOrderDetailsByOrderId($id){
		return (isset($id)?$this->db->query("SELECT orders.*,orderstatus.StatusName FROM {$this->table_name} LEFT JOIN orderstatus ON orders.status=orderstatus.status_fs WHERE orders.id=$id LIMIT 1")->fetch_assoc():false);
	}
	public function delay($id){
		return $this->db->query("UPDATE {$this->table_name} SET status=2 WHERE id=$id");
	}
	public function deliver($id){
		return $this->db->query("UPDATE {$this->table_name} SET status=1 WHERE id=$id");
	}
}