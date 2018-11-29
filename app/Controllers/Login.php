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
		$data['css']=$this->insertCSS("login.css");
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
					Sessions::set("uname", $account['uname']);
					Sessions::set("login", true);
					Sessions::set("user_group", 1);
					header("Location:".APP_URL."home");
				} else return $val->getErrors(5);
			} else return $val->getErrors(6);
		} else return $val->getErrors();
	}
}