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

class User extends UserController
{
	public function index(){
		$data['css']=$this->insertCSS("login.css");
		$data['css2']=$this->insertCSS("user.css");
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
			->addButton("submit", "Update");
		$data['form']=$form->output();
		$data['css']=$this->insertCSS("login.css");
		$data['css2']=$this->insertCSS("user.css");
		$data['js']=$this->insertJS("animationworkaround.js");
		if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
			if ($this->validate()==false){
				$user=new \App\Models\User();
				$userid=$user->getUserByUname(Sessions::get("uname"));
				$user->updateUserById($userid['id'], $_POST);
				header("Location:".APP_URL."user");
			}
			else{
				$data['errors']=$this->validate();
			}
		}
		$this->view->render("user/edit", $data);
	}
	private function validate(){
		$val=new Validator();
		$val->val($_POST['name'], "Name", true, "textnum", 2, 50);
		$val->val($_POST['surname'], "Surname", true, "textnum", 2, 50);
		if ($val->getErrors()!=false){
			return $val->getErrors();
		}else return false;
	}
}