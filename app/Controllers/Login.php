<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 23/11/2018
 * Time: 09:16
 */

namespace App\Controllers;


use App\Core\GuestController;
use App\Libs\Formbuilder;
use App\Libs\Sessions;
use App\Libs\Validator;
use App\Models\User;

class Login extends GuestController {
	public function index(){
		$this->view->files_css=["login.css"];
		$this->view->files_js=["animationworkaround.js"];
		if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
			$data['errors'] = $this->login();
		}
		$form=new Formbuilder("login");
		$form->addInput("text", "uname", "Username", ['class'=>'jsfocusactive'])
		->addInput("password", "pass", "Password", ['class'=>'jsfocusactive'])
		->addButton("Submit", "Log In");
		$data['form']=$form->output();
		$this->view->render("login/index", $data);
		if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
			$this->login();
		}
	}
	public function login(){
		$val=new Validator();
		$val->val($_POST['uname'], "Username", true, "textnum", 3, 30);
		$val->val($_POST['pass'], "Password", true, "textnum", 3, 30);
		if ($val->getErrors()===false){
			$user=new User();
			$account=$user->getUserByUname($_POST['uname']);
			$pw_hash=explode(":", $account['password']);

			if ($account["uname"] == $_POST['uname'] && sha1($_POST['pass'] . $pw_hash[1]) == $pw_hash[0]) {
				if($account['is_active']==1){
					if ($account['locked']!=1){
						$cart=new \app\Models\Cart();
						Sessions::del("cart");
						Sessions::del("cart_count");
						Sessions::set("uname", $account['uname']);
						Sessions::set("id", $account['id']);
						Sessions::set("login", true);
						Sessions::set("user_group", $account['roles_fs']);
						Sessions::set("cart_count", $cart->getCartCount());
						header("Location:".APP_URL."home");
					}else return $val->getErrors(9);
				} else return $val->getErrors(5);
			} else return $val->getErrors(6);
		} else return $val->getErrors();
	}
}