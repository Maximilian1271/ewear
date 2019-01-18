<?php

namespace App\Core;


use App\Libs\Logout;

class Controller
{
	public $view;
	public function __construct()
	{
		if (count($_SESSION)>0&&!isset($_SESSION['flyk1XIvh3ncxiLvBoKC'])){
			Logout::logout(); //if Session for some reason invalid, clear Session (happens when using sessions from foreign projects)
		}
		$this->view=new View();
	}
}