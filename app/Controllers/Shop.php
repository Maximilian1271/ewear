<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 29/11/2018
 * Time: 21:39
 */

namespace app\Controllers;


use App\Core\Controller;
use app\Models\Product;

class Shop extends Controller
{
	public function index(){
		if(isset($_POST['search'])){
			$product=new Product();
			$data['prod']=$product->buildShop($_POST['search']);
			$this->view->files_css=['shop.css'];
			$this->view->render("shop/index", $data);
		}
		else{
			$product=new Product();
			$data['prod']=$product->getAll();
			$this->view->files_css=['shop.css'];
			$this->view->render("shop/index", $data);
		}
	}
	public function prod($parm){
		$product=new Product();
		if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['size'])){
			$id=$product->getProduct($parm);
			if(!isset($_POST['colour'])){
				$_POST['colour']="null";
			}
			$cart=array("id"=>$id['id'], "size"=>$_POST['size'], "num"=>$_POST['num'], "colour"=>$_POST['colour']);
			$_SESSION['cart'][]=json_encode($cart);
			if(isset($_SESSION['cart_count'])){
				$_SESSION['cart_count']++;
			}else{
				$_SESSION['cart_count']=0;
				$_SESSION['cart_count']++;
			}
			header("Location:".APP_URL."shop");
		}
		$data['prod']=$product->getProduct($parm);
		$this->view->files_css=['product.css'];
		$this->view->render("shop/prod", $data);
	}
}