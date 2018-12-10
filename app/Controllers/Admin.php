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
use app\Models\Product;

class Admin extends AdminController
{
	public function index(){
		$this->view->files_css=["admin.css"];
//		$data['css']=$this->insertCSS("admin.css");
		$this->view->render("admin/index");
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
//		$data['css']=$this->insertCSS("admin.css");
		$this->view->files_css=["admin.css"];
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
			$this->view->files_css=['admin.css'];
//			$data['css']=$this->insertCSS("admin.css");
			$data['form']=$edit->output();
			$data['user']=$user;
			$this->view->render("admin/useredit", $data);
		}else header("Location:".APP_URL."admin/user");
	}
	public function product($id=null){
		$prod=new Product();
		$markup="";
		foreach($prod->getAll() as $product){
			$img=explode("/", $product['image']);
			$img=end($img);
			$date=date("D M j Y, G:i:s", $product['created_at']);
			if ($product['in_stock']==="1"){
				$markup.="<tr class='instock'>";
				$status="yes";
			}
			elseif ($product['in_stock']==="0"){
				$markup.="<tr class='outstock'>";
				$status="no";
			}

			$markup.="<td><a href=\"".APP_URL."shop/prod/{$product['title']}\">{$product['title']}</a></td><td>{$product['product_desc']}</td><td>{$product['base_price']}</td><td>$img</td><td>$date</td><td>$status</td><td>{$product['CategoryName']}</td>";
			$markup.="<td><a href='prodedit/{$product['id']}'>Edit</a></td>";
			$markup.="</tr>";
		}
		$this->view->files_css=["admin.css"];
//		$data['css']=$this->insertCSS("admin.css");
		$data['prod']=$markup;
		$this->view->render("admin/product", $data);
	}
	public function prodedit($id){
		$product=new Product();
		$selected=$product->getProductById($id);
		$form=new Formbuilder("Prodedit", "POST", "", true);
		$form->addInput("text", "Title", "Title", ["value"=>$selected['title']])
		->addInput("text", "DescShort", "Short Text", ["value"=>$selected['product_desc']])
		->addInput("number", "InStock", "In Stock", ["value"=>$selected['in_stock'], "min"=>"0", "max"=>"1"])
		->addInput("number", "basePrice", "Base Price", ["value"=>$selected['base_price'], "min"=>"0"])
		->addTextarea("desLong", "Long Text", $selected['product_desc_long'])
		->addButton("update", "update");
		if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
			if($product->updateProductById($id, $_POST)){
				header("Location: ".APP_URL."admin/prodedit/".$id);
			}
			else die("An error has occured");
		}
		$data['prod']=$selected;
		$data['form']=$form->output();
		$this->view->files_css=['admin.css'];
//		$data['css']=$this->insertCSS("admin.css");
		$this->view->render("admin/prodedit", $data);
	}
	public function productAdd(){
		$this->view->render("admin/productadd");
	}
}