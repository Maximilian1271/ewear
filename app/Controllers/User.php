<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 24/11/2018
 * Time: 17:18
 */

namespace App\Controllers;


use App\Core\UserController;

class User extends UserController
{
	public function index(){
		$this->view->render("user/index");
	}
	public function settings(){
	}
}