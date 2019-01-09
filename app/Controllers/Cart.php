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
use app\Models\Order;

class Cart extends UserController {
	public function index(){
		$this->view->files_js=(["animationworkaround.js", "cartcheck.js"]);
		if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"&& isset($_POST['place'])){
			header("Location: cart/pay");
		}
		if (isset($_SESSION['cart'])){
			$cart=new \app\Models\Cart();
			$cart->sessionToCart($_SESSION);
		}
		if (isset($_SESSION['cart_count'])&&$_SESSION['cart_count']>0){
			$cart=new \app\Models\Cart();
			$data['cart']=$cart->resolveCart();
		}
		$this->view->files_css=["cart.css", "login.css"];
		if (isset($data)){
			$this->view->render("cart/index", $data);
		}else $this->view->render("cart/index");

	}
	public function clear(){
		$cart=new \app\Models\Cart();
		$cart->clearCart();
		header("Location:". APP_URL."home");
	}
	public function checkout(){
		if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"&& isset($_POST['place'])) {
			$cart=new \app\Models\Cart();
			$shipping=array(
				"Name"=>$_POST['name'],
				"Address"=>$_POST['address'],
				"Postal Code (ZIP)"=>$_POST['zip'],
				"Payment Method"=>$_POST['pay']
			);
			$data['shipping']=$shipping;
			$data['cart']=$cart->resolveCart();
			$this->view->files_css=["login.css", "user.css", "cart.css"];
			$this->view->render("cart/checkout", $data);
		}
		else echo "You may not order an empty cart";
	}
}