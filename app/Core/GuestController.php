<?php
/**
 * Created by PhpStorm.
 * User: maximilian
 * Date: 21/11/18
 * Time: 17:16
 */

namespace App\Core;
use App\Libs\Sessions;

class GuestController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->checkGroup();
	}
	public function checkGroup(){
		if (Sessions::get('flyk1XIvh3ncxiLvBoKC')==1){
			header('Location:'.APP_URL."home");
		}
	}
}