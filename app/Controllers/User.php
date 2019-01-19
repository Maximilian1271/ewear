<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 24/11/2018
 * Time: 17:18
 */

namespace App\Controllers;


use App\Core\UserController;
use App\Libs\Formbuilder;
use App\Libs\Sessions;
use App\Libs\Validator;
use App\Models\Order;

class User extends UserController
{
	public function index(){
		$this->view->files_css=['login.css', 'user.css'];
		$user=new \App\Models\User();
		$data['user']=$user->getUserByUname(Sessions::get("uname"));
		$this->view->render("user/index", $data);
	}
	public function edit(){
		$user=new \App\Models\User();
		$user=$user->getUserByUname(Sessions::get("uname"));
		$json=json_decode($user['data'], true);
		$form=new Formbuilder("login");
		$form->addInput("text", "name", "Name", ["class"=>"jsfocusactive", "value"=>$json['name']])
			->addInput("text", "surname", "Surname", ["class"=>"jsfocusactive", "value"=>$json['surname']])
			->addInput("text", "address", "Street Address", ["class"=>"jsfocusactive", "value"=>$json['address']])
			->addInput("text", "zip", "ZIP Code", ["class"=>"jsfocusactive", "value"=>$json['zip']])
			->addInput("password", "pw", "Password", ["class"=>"jsfocusactive"])
			->addInput("password", "pw-rep", "Repeat Password", ["class"=>"jsfocusactive"])
			->addButton("submit", "Update")
			->addButton("remove", "Remove Account", ["class"=>"remove", "onclick"=>"var x=confirm('Are you sure you want to delete your Account?'); if(x==false){return false}"]);
		$data['form']=$form->output();
		$this->view->files_css=['login.css', 'user.css'];
		$this->view->files_js=['animationworkaround.js'];
		$user=new \App\Models\User();
		$userid=$user->getUserByUname(Sessions::get("uname"));
		if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
			if ($this->validate()==false && !isset($_POST['remove'])){
				$user->updateUserById($userid['id'], $_POST);
				header("Location:".APP_URL."user");
			}
			if(isset($_POST['remove'])){
				$this->remove($userid['id']);
			}
			else{
				$data['errors']=$this->validate();
			}
		}
		$this->view->render("user/edit", $data);
	}
	public function orders(){
		$order=new Order();
		$data['orders']=$order->getOrders($_SESSION['id']);
		$this->view->files_css=['login.css', "cart.css"];
		$this->view->render("user/orders", $data);
	}
	public function order($id){
		$order=new Order();
		$order=$order->getOrderDetailsByOrderId($id);
		if ($_SESSION['id']!=$order['user_fs']){
			die("You may not watch orders whom you are not the purchaser from, sorry"); //In the unlikely event that a user guesses another users uniqid. This is basically impossible but i implemented this before using uniqid's but rather order id's, which was, frankly, quite stupid
		}else{
			$data['order']=$order; //hand over order detail to view and render
			$this->view->files_css=["login.css", "cart.css"];
			$this->view->render("user/order", $data);
		}
	}
	public function cancel($id){
		$order=new Order();
		$orderCont=$order->getOrderDetailsByOrderId($id);
		if($orderCont['status']==0){
			if($order->cancel($id)) header("Location:".APP_URL."user/order/".$id);
		}
		else return false;
	}
	private function validate(){
		$val=new Validator();
		$val->val($_POST['name'], "Name", true, "textnum", 2, 50);
		$val->val($_POST['surname'], "Surname", true, "textnum", 2, 50);
		$val->comp([$_POST['pw'], "Password"], [$_POST['pw-rep'], "Repeat Password"]);
		if ($val->getErrors()!=false){
			return $val->getErrors();
		}else return false;
	}
	private function remove($id){
		$user=new \App\Models\User();
		if($user->delUserById($id)==true){
			Logout::index();
		}
	}
}