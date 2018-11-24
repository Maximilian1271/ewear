<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 23/11/2018
 * Time: 15:30
 */

namespace App\Controllers;


use App\Core\GuestController;
use App\Libs\Formbuilder;
use App\Libs\Validator;

class Register extends GuestController
{
	public function index(){
		if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
			$data['errors'] = $this->register();
		}
		$form=new Formbuilder("register");
		$form->addInput("text", "name", "Name", ["class"=>"jsfocusactive"])
			->addInput("text", "surname", "Surname", ["class"=>"jsfocusactive"])
			->addInput("text", "uname", "Username", ["class"=>"jsfocusactive"])
			->addInput("email", "email", "E-Mail Address", ["class"=>"jsfocusactive"])
			->addInput("text", "Address", "Street Address", ["class"=>"jsfocusactive"])
			->addInput("text", "zip", "ZIP Code", ["class"=>"jsfocusactive"])
			->addInput("password", "pw", "Password", ["class"=>"jsfocusactive"])
			->addInput("password", "pw2", "Repeat Password", ["class"=>"jsfocusactive"])
			->addCheckbox(["news"=>"I would like to receive the newsletter", "tos"=>"I have read and accept the <a href=\"register/tos\" target='_blank'>Terms of Use</a>"])
			->addButton("submit", "Register", ["class"=>"submit"]);
		$data['form']=$form->output();
		$this->view->render("register/index", $data);
	}
	public function tos(){
		if ($_GET['url']=="register/tos"){
			$this->view->render("register/tos");
		}
	}
	public function register(){
		$val=new Validator();
		$val->val($_POST['name'], "Name", true, "textnum", 2, 50);
		$val->val($_POST['surname'], "Surname", true, "textnum", 2, 50);
		$val->val($_POST['uname'], "Username", true, "textnum", 2, 50);
		$val->val($_POST['email'], "E-Mail-Address", true, "email", 2, 50);
		$val->val($_POST['address'], "Surname", false, "textnum", 2, 50);



		if($val->getErrors()===false){
			//register
		}else return $val->getErrors();
	}
}