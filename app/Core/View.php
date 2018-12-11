<?php
namespace App\Core;
use App\Libs\Sessions;
use App\Models\User;

class View
{
	public $files_css = array();
	public $files_js = array();

	public function __construct(){
		if (isset($_SESSION['login'])){
			$checkuser=new User();
			if($checkuser->checkLock(Sessions::get("id"))==true){
				header("Location:".APP_URL."logout");
			}
		}
	}

	public function render($view, $data = array(), $tpl = "app"){
		require __DIR__ . "/../../views/layouts/" . $tpl . ".php";
	}
	private function loadCSS(){
		$markup = "";
		if (count($this->files_css) > 0) {
			foreach ($this->files_css as $file) {
				$markup .= "<link rel='stylesheet' href='".APP_URL."assets/css/$file'>";
			}
			return $markup;
		} else {
			return false;
		}
	}
	private function loadJS(){
		$markup = "";
		if (count($this->files_js) > 0) {
			foreach ($this->files_js as $file) {
//				$markup .= "<script src='".APP_URL."assets/js/$file'></script>";
				$markup.="<script src='".APP_URL."assets/js/$file'></script>";
			}
			return $markup;
		} else {
			return false;
		}
	}
}