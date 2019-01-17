<?php
namespace App\Controllers;

use App\Core\Controller;

class error extends Controller {
	public function index()
	{
		$this->view->render("error/error");
	}
	public function login(){
		$data['code']="You don't seem to be logged in. Please log in to do that";
		$this->view->render("error/error", $data);
	}
	public function perm(){
		$data['code']="You seem to have insufficient permissions. Sorry about that :/";
		$this->view->render("error/error", $data);
	}
	public function query(){
		$data['code']="There has been an error with your query. Please try something different";
		$this->view->render("error/error", $data);
	}
	public function cart(){
		$data['code']="Your Cart seems to be empty";
		$this->view->render("error/error", $data);
	}
	public function checkout(){
		$data['code']="You may not order an empty cart";
		$this->view->render("error/error", $data);
	}
	public function empty(){
		$data['code']="Your Query returned no results. We are sorry about that";
		$this->view->render("error/error", $data);
	}
	public function csrf(){
		$data['code']="You may not order the same order, twice in a row (csrf mismatch)";
		$data['home']=true;
		$this->view->render("error/error", $data);
	}
}