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
use App\Models\User;

class Register extends GuestController
{
	public function index(){
		$this->view->files_css=['register.css'];
		$this->view->files_js=['animationworkaround.js'];
		if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
			$data['errors'] = $this->register();
		}
		$form=new Formbuilder("register");
		$form->addInput("text", "name", "Name", ["class"=>"jsfocusactive"])
			->addInput("text", "surname", "Surname", ["class"=>"jsfocusactive"])
			->addInput("text", "uname", "Username", ["class"=>"jsfocusactive"])
			->addInput("email", "email", "E-Mail Address", ["class"=>"jsfocusactive"])
			->addInput("text", "address", "Street Address", ["class"=>"jsfocusactive"])
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
		$val->val($_POST['pw'], "Password", true, "textnum", 5, 999);
		$val->val($_POST['pw2'], "Repeat Password", true, "textnum", 5, 999);
		$val->comp([$_POST['pw'], "Password"], [$_POST['pw2'], "Repeat Password"]);
		if (!isset($_POST['tos'])){
			$val->val("", "Terms of Service", true, "num");
		}
		if($val->getErrors()===false){
			$user=new User();
			if($user->checkUname($_POST['uname'])){
				$val->getErrors(7);
			}
			if($user->checkEmail($_POST['email'])){
				$val->getErrors(8);
			}
			if($val->getErrors()!==false){
				return $val->getErrors();
			}
			if(isset($_POST['newsletter'])){
				$newsletter=1;
			}else $newsletter=0;
			$hash=$user->setUser($_POST['uname'], $_POST['email'], $_POST['pw'], $_POST['name'], $_POST['surname'], $_POST['address'], $_POST['zip'], $newsletter);
			header("Location:".APP_URL."register/success");

		}else return $val->getErrors();
		return true;
	}
	public function success(){
		$this->view->files_css=['login.css'];
		$this->view->render("register/success");
	}
}