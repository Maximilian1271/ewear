<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 23/11/2018
 * Time: 06:34
 */

namespace App\Controllers;
use App\Core\Controller;

class Home extends Controller
{
	public function index(){
		$this->view->files_css=['home.css'];
		$this->view->files_js=['slider.js'];
		$this->view->render("home/index");
	}
}