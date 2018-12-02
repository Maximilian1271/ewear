<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 02/12/2018
 * Time: 23:35
 */

namespace app\Controllers;


use App\Core\UserController;
use App\Libs\Sessions;

class Cart extends UserController {
	public function index(){
		$data['css']=$this->insertCSS("cart.css");
		$cart=new \app\Models\Cart();
		$data['cart']=$cart->getCartById(Sessions::get('id'));
		$this->view->render("cart/index", $data);
	}
}