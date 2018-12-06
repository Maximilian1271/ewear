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
		$product=new Product();
		$data['prod']=$product->getAll();
//		$data['css']=$this->insertCSS("shop.css");
		$this->view->files_css=['shop.css'];
		$this->view->render("shop/index", $data);
	}
	public function prod($parm){
		$product=new Product();
		if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){

		}
		$data['prod']=$product->getProduct($parm);
//		$data['css']=$this->insertCSS("product.css");
		$this->view->files_css=['product.css'];
		$this->view->render("shop/prod", $data);
	}
	public function search(){

	}
}