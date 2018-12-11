<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 02/12/2018
 * Time: 23:45
 */

namespace app\Models;


use App\Core\Model;
use App\Libs\Sessions;

class Cart extends Model{
	protected $table_name="cart";
	public function getCartById($id){
		return $this->db->query("SELECT * FROM {$this->table_name} WHERE user_fs=$id")->fetch_assoc();
	}
	public function createCart($id=null){
		if($id!=null){
			$this->db->query("INSERT INTO {$this->table_name} (user_fs) VALUE ($id)");
		}
	}
	public function sessionToCart($session=array()){
		$data=implode("::", $session['cart']);
		if($_SESSION['cart_count']>0){
			$this->db->query("UPDATE {$this->table_name} SET data=CONCAT(data,'::$data') WHERE user_fs={$_SESSION['id']}");
		}
		else{
			$this->db->query("UPDATE {$this->table_name} SET data='$data' WHERE user_fs={$_SESSION['id']}");
		}
		unset($_SESSION['cart']);
	}
	public function getCartCount(){
		$res=$this->db->query("SELECT data FROM {$this->table_name} WHERE user_fs={$_SESSION['id']}")->fetch_assoc();
		$cart=array_filter(explode("::", $res['data']));
		return count($cart);
	}
	public function resolveCart(){
		$cart=$this->getCartById(Sessions::get('id'));
		$cart=$cart['data'];
		$cart=substr($cart, 2);
		$cart=explode("::", $cart);
		$res=array();
		foreach ($cart as $item) {
			$entry=json_decode($item, true);
			$res[]=$entry;
		}
		return $res;
	}
	public function clearCart(){
		$this->db->query("UPDATE {$this->table_name} SET data='' WHERE user_fs={$_SESSION['id']}");
		unset($_SESSION['cart_count']);
	}
}