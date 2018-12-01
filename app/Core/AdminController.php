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
			echo "must be logged in to view";
			exit();
		}
		if(Sessions::get('user_group')<2){
			echo "must be admin to view";
			exit();
		}
	}
}