<?php
/**
 * Created by PhpStorm.
 * User: maximilian
 * Date: 21/11/18
 * Time: 17:12
 */

namespace App\Core;
use App\Libs\Sessions;

class AdminController extends Controller {
	public function __construct()
	{
		parent::__construct();
		$this->checkGroup();
	}
	private function checkGroup(){
		if(Sessions::get('user_group')!=2){
			$data['errors']="Must be Admin to access this page! If you think this is incorrect, contact administrator";
//			$this->view->render("index/home", $data);
			header("Location:".APP_URL."admin");
		}
	}
}