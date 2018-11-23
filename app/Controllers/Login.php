<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 23/11/2018
 * Time: 09:16
 */

namespace App\Controllers;


use App\Core\Controller;
use App\Libs\Formbuilder;
use App\Libs\Validator;

class Login extends Controller {
	public function index(){
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

		}
		else return $val->getErrors();
	}
}