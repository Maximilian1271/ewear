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
use App\Models\Order;
use app\Models\Product;

class Admin extends AdminController
{
	public function index(){
		$this->view->files_css=["admin.css"];
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
			$data['form']=$edit->output();
			$data['user']=$user;
			$this->view->render("admin/useredit", $data);
		}else header("Location:".APP_URL."admin/user");
	}
	public function product(){
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
		$data['prod']=$markup;
		$this->view->render("admin/product", $data);
	}
	public function trash(){
		$prod=new Product();
		$markup="";
		foreach($prod->getAllTrash() as $product){
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
			$markup.="<td><a href='undelete/{$product['id']}'>Undelete</a></td>";
			$markup.="</tr>";
		}
		$this->view->files_css=["admin.css"];
		$data['prod']=$markup;
		$this->view->render("admin/trash", $data);
	}
	public function undelete($id){
		$product=new Product();
		if($product->undelete($id)){
			header("Location:".APP_URL."admin/trash");
		}
	}
	public function prodedit($id){
		$product=new Product();
		$selected=$product->getProductById($id);
		$form=new Formbuilder("Prodedit", "POST", "", true);
		$form->addInput("text", "Title", "Title", ["value"=>$selected['title']])
		->addInput("text", "DescShort", "Short Description", ["value"=>$selected['product_desc']])
		->addInput("number", "InStock", "In Stock", ["value"=>$selected['in_stock'], "min"=>"0", "max"=>"1"])
		->addInput("number", "basePrice", "Base Price", ["value"=>$selected['base_price'], "min"=>"0"])
		->addTextarea("desLong", "Long Description", $selected['product_desc_long'])
		->addInput("file", "img", "Product Image", ["accept"=>"image/*"])
		->addButton("update", "update")
		->addButton("del", "Softdelete this Product");
		if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"&&!isset($_POST['del'])){
			if($product->updateProductById($id, $_POST, $_FILES)){
				header("Location: ".APP_URL."admin/prodedit/".$id);
			}
			else die("An error has occured");
		}
		if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"&&isset($_POST['del'])){
			if($product->softDeleteById($id)){
				header("Location:".APP_URL."admin/product");
			}else die("An error occured");
		}
		$data['prod']=$selected;
		$data['form']=$form->output();
		$this->view->files_css=['admin.css'];
		$this->view->render("admin/prodedit", $data);
	}
	public function productAdd(){
		if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
			$product=new Product();
			$product->addProduct($_POST, $_FILES);
		}
		$form=new Formbuilder("Prodedit", "POST", "", true);
		$form->addInput("text", "title", "Title")
			->addInput("text", "desc", "Short Description")
			->addInput("number", "stock", "In Stock", ["min"=>0, "max"=>1, "value"=>1])
			->addInput("number", "baseprice", "Base Price", ["min"=>0])
			->addTextarea("longDesc", "Long Description")
			->addInput("text", "colour", "Colour Variants", ["placeholder"=>"Separate values with commas"])
			->addInput("file", "img", "Product Image", ["accept"=>"image/*"])
			->addButton("submit", "submit");
		$data['form']=$form->output();
		$this->view->files_css=['admin.css'];
		$this->view->render("admin/productadd", $data);
	}
	public function order(){
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
			$markup.="<td><a href='orderlist/{$row['id']}'>Show Orders</a></td>";
			$markup.="</tr>";
		}
		$data['userList']=$markup;
		$this->view->files_css=["admin.css"];
		$this->view->render("admin/order", $data);
	}
	public function orderlist($id){
		$orders=new Order();
		$data['orders']=$orders->getOrders($id);
		$this->view->files_css=['login.css', "cart.css"];
		$this->view->render("admin/orderlist", $data);
	}
	public function orderdetail($id){
		$order=new Order();
		$order=$order->getOrderDetailsByOrderId($id);
		$markup="";
			$jsonAddress=json_decode($order['address'], true);
			$markup="";
			$markup.="<tr>";
			$markup.="<td class='verticalSplit'>Name:{$jsonAddress['Name']}, Address: {$jsonAddress['Address']}, {$jsonAddress['Postal_Code_(ZIP)']}</td>";
			if(count(explode("::", $order['cart_data']))>2){
				$markup.="<td class='verticalSplit'>";
				foreach (explode("::", $order['cart_data']) as $item){
					$jsonCart=json_decode($item, true);
					$prodname=new Product();
					if($jsonCart!=NULL){ //Sloppy explode fix. First array index will always be NULL since cart data starts with "::"
						$product=$prodname->getProductById($jsonCart['id']);
						$markup.="Title: {$product['title']}, Size: {$jsonCart['size']}, Amount: {$jsonCart['num']}, Colour: {$jsonCart['colour']} <br>";
					}
				}
				$markup.="</td>";
			}
			else{
				$jsonCart=json_decode(str_replace("::", "", $order['cart_data']), true);
				$prodname=new Product();
				$product=$prodname->getProductById($jsonCart['id']);
				$markup.="<td class='verticalSplit'>Title: {$product['title']}, Size: {$jsonCart['size']}, Amount: {$jsonCart['num']}, Colour: {$jsonCart['colour']}</td>";
			}
			$markup.="<td class='verticalSplit'>".date("F j, Y, g:i a", $order['created_at'])."</td>";
			$markup.="<td class='verticalSplit'>{$order['StatusName']}";
			$markup.="</td>";
			$markup.="<td class='noborder'><a href='".APP_URL."admin/delay/$id"."'>Mark as Delayed</a></td><td class='noborder'><a href='".APP_URL."admin/deliver/$id"."'>Mark as Delivered</a> </td><td class='noborder'><a href='".APP_URL."admin/processing/$id"."'>Mark as Processing</a> </td>";
		$data['user_id']=$order['user_fs'];
		$data['id']=$id;
		$data['order']=$markup;
		$this->view->files_css=['login.css', 'orderdetail.css'];
		$this->view->render("admin/orderdetail", $data);
	}
	public function delay($id){
		$order= new Order();
		if($order->delay($id)){
			header("Location:".APP_URL."admin/orderdetail/".$id);
		}else die("An error occured with the DB");
	}
	public function deliver($id){
		$order= new Order();
		if($order->deliver($id)){
			header("Location:".APP_URL."admin/orderdetail/".$id);
		}else die("An error occured with the DB");
	}
	public function processing($id){
		$order= new Order();
		if($order->process($id)){
			header("Location:".APP_URL."admin/orderdetail/".$id);
		}else die("An error occured with the DB");
	}
}