<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 24/11/2018
 * Time: 17:11
 */

namespace App\Controllers;


use App\Libs\Sessions;

class Logout
{
	public function index(){
		if (isset($_SESSION['cart'])){
			$cart=new \app\Models\Cart();
			$cart->sessionToCart($_SESSION);
		}
		Sessions::clear();
		header("Location:".APP_URL);
	}
}