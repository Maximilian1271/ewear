<?php
namespace App\Core;
use App\Libs\Logout;
use App\Libs\Sessions;
use App\Models\User;

class View
{
	public $files_css = array();
	public $files_js = array();

	public function __construct(){
		if (isset($_SESSION)&&isset($_SESSION['flyk1XIvh3ncxiLvBoKC'])){    //check if user has been locked, if so immediately log out
			$checkuser=new User();
			if($checkuser->checkLock(Sessions::get("id"))==true){
				Logout::logout();
			}
		}
	}

	public function render($view, $data = array(), $tpl = "app"){
		require __DIR__ . "/../../views/layouts/" . $tpl . ".php";
	}
	private function loadCSS(){     //load CSS from array if given, to be used via public $files_css=array()
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
	private function loadJS(){      //load JS from array if given, to be used via public $files_js=array()
		$markup = "";
		if (count($this->files_js) > 0) {
			foreach ($this->files_js as $file) {
				$markup.="<script src='".APP_URL."assets/js/$file'></script>";
			}
			return $markup;
		} else {
			return false;
		}
	}
}