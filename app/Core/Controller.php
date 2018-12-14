<?php

namespace App\Core;


class Controller
{
	public $view;
	public function __construct()
	{
		$this->view=new View();
	}
//	public function insertCSS($filename){
//		if (file_exists("./assets/css/{$filename}")){
//			return "<link rel=\"stylesheet\" href=\"/ewear/assets/css/{$filename}\">";
//		}
//	}
//	public function insertJS($filename){
//		if (file_exists("./assets/js/{$filename}")){
//			return "<script src=\"/ewear/assets/js/{$filename}\"></script>";
//		}
//	}
}