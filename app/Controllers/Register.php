<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 23/11/2018
 * Time: 15:30
 */

namespace App\Controllers;


use App\Core\Controller;
use App\Libs\Formbuilder;

class Register extends Controller
{
	public function index(){
		$form=new Formbuilder("register");
		$form->addInput("text", "name", "Name", ["class"=>"jsfocusactive"])
			->addInput("text", "surname", "Surname", ["class"=>"jsfocusactive"])
			->addInput("text", "uname", "Username", ["class"=>"jsfocusactive"])
			->addInput("email", "email", "E-Mail Address", ["class"=>"jsfocusactive"])
			->addInput("text", "Address", "Street Address", ["class"=>"jsfocusactive"])
			->addInput("text", "zip", "ZIP Code", ["class"=>"jsfocusactive"])
			->addInput("password", "pw", "Password", ["class"=>"jsfocusactive"])
			->addInput("password", "pw2", "Repeat Password", ["class"=>"jsfocusactive"])
			->addCheckbox(["I would like to receive the newsletter", "I have read and accept the TOS"])
			->addButton("submit", "Register");
		$data['form']=$form->output();
		$this->view->render("register/index", $data);
	}
}