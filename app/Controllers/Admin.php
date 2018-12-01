<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 30/11/2018
 * Time: 13:47
 */

namespace app\Controllers;


use App\Core\AdminController;

class Admin extends AdminController
{
	public function index(){
		$this->view->render("admin/index");
	}
}