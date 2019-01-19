<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 13/12/2018
 * Time: 03:19
 */

namespace app\Controllers;


class Logout
{
	public function index(){
		\App\Libs\Logout::logout();
	}
}