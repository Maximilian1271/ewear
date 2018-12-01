<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 30/11/2018
 * Time: 13:47
 */

namespace app\Controllers;


use App\Core\AdminController;
use App\Libs\Formbuilder;
use App\Libs\Sessions;

class Admin extends AdminController
{
	public function index(){
		$data['css']=$this->insertCSS("admin.css");
		$this->view->render("admin/index", $data);
	}
	public function user(){
		$user=new \App\Models\User();
		$markup="";
		foreach ($user->getAll() as $row) {
			$json=json_decode($row['data'], true);
			if($row['roles_fs']>1){
				$markup.="<tr class='admin'>";
			}
			elseif ($row['locked']==1){
				$markup.="<tr class='locked'>";
			}
			else $markup.="<tr>";
			$markup.="<td>{$json['name']}</td><td>{$json['surname']}</td><td>{$row['uname']}</td><td>{$row['email']}</td>";
			if($row['newsletter']){
				$markup.="<td>Yes</td>";
			}else $markup.="<td>No</td>";
			$markup.="<td><a href='useredit/{$row['id']}'>Edit</a></td>";
			$markup.="</tr>";
		}
		$data['userList']=$markup;
		$data['css']=$this->insertCSS("admin.css");
		$this->view->render("admin/user", $data);
	}
	public function useredit($id=null){
		$user=new \App\Models\User();
		if($user->getUserbyId($id)!=false){
			$user=$user->getUserbyId($id);
			$json=json_decode($user['data'], true);
			$edit=new Formbuilder("useredit");
			$edit->addInput("text", "name", "Name", ["value"=>$json['name']])
				->addInput("text", "surname", "Surname", ["value"=>$json['surname']])
				->addInput("text", "uname", "Username", ["value"=>$user['uname']])
				->addInput("email", "email", "E-Mail Address", ["value"=>$user['email']])
				->addInput("text", "address", "Street Address", ["value"=>$json['address']])
				->addInput("text", "zip", "ZIP Code", ["value"=>$json['zip']])
				->addButton("submit", "Update \"{$user['uname']}\"");
			if($user['locked']==1){
				$edit->addButton("unlock", "Unlock User");
			}
			elseif($user['locked']==0){
				if ($user['id']==Sessions::get('id')){
					$edit->addButton("selflock", "Cannot lock own user", ["disabled"=>""]);
				}
				else $edit->addButton("lock", "Lock User");
			}
			if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
				$user=new \App\Models\User();
				if(isset($_POST['lock'])){
					$user->lockUserById($id);
					header("Location:".APP_URL."admin/useredit");
				}
				if(isset($_POST['unlock'])){
					$user->unlockUserById($id);
					header("Location:".APP_URL."admin/useredit");
				}
				if (isset($_POST['submit'])){
					$user->updateUserById($id, $_POST);
					header("Location:".APP_URL."admin/useredit");
				}
			}
			$data['css']=$this->insertCSS("admin.css");
			$data['form']=$edit->output();
			$data['user']=$user;
			$this->view->render("admin/useredit", $data);
		}else header("Location:".APP_URL."admin/user");
	}
}