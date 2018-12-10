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
		if (Sessions::get('login')!=1){
			header("Location:".APP_URL."error/login");
//			error(["You don't seem to be logged in. Please log in to do that"]);
		}
		if(Sessions::get('user_group')<2){
			header("Location:".APP_URL."error/perm");
//			error(["You seem to have insufficient permissions. Sorry about that :/"]);
		}
	}
}