<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 29/11/2018
 * Time: 21:42
 */

namespace app\Models;


use App\Core\Model;

class Product extends Model{
	protected $table_name = "products";
	protected $targetFolder= "assets/images/product/";
	public function setProduct($data){

	}
	public function getProduct($name=null){
		if ($name!=null&&is_string($name)){
			$sql="SELECT * FROM {$this->table_name} WHERE title='$name' LIMIT 1";
			$stmt=$this->db->query($sql)->fetch_assoc();
			return $stmt;
		}
		else return false;
	}
	public function getProductById($id){
		return $this->db->query("SELECT * FROM {$this->table_name} WHERE id=$id LIMIT 1")->fetch_assoc();
	}
	public function getAll(){
		$sql="SELECT {$this->table_name}.*, productcategory.CategoryName FROM {$this->table_name} LEFT JOIN productcategory ON category_fs=productcategory.id";
		$stmt=$this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
		return $stmt;
	}
	public function buildShop($query){
		$sql="SELECT {$this->table_name}.*, productcategory.CategoryName FROM {$this->table_name} LEFT JOIN productcategory ON category_fs=productcategory.id WHERE title LIKE '%{$query}%'";
		$stmt=$this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
		return $stmt;
	}
	public function updateProductById($id=null, $post=array()){
		if (id!=null){
			$stmt=$this->db->prepare("UPDATE {$this->table_name} SET title=?, product_desc=?, product_desc_long=?, in_stock=?, base_price=? WHERE id=$id");
			$stmt->bind_param("sssii", $post['Title'], $post['DescShort'], $post['desLong'], $post['InStock'], $post['basePrice']);
			return($stmt->execute()?true:false);
		}
	}
	public function addProduct($post=array(), $files=array()){
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		if($post>0){
			if($files>0){
				$cat=1;
				$colour=json_encode(array("colour"=>explode(",", trim($post['colour']))));
				$time=time();
				$img=$this->targetFolder.$files['img']['name'];
				move_uploaded_file($files['img']['tmp_name'], $img);
				$stmt=$this->db->prepare("INSERT INTO {$this->table_name} (title, product_desc, product_desc_long, base_price, image, created_at, in_stock, data, category_fs) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$stmt->bind_param("sssisissi", $post['title'], $post['desc'], $post['longDesc'], $post['baseprice'], $files['img']['name'], $time, $post['stock'], $colour, $cat);
				if($stmt->execute())header("Location:".APP_URL."shop/prod/{$post['title']}");
				else return false;
//				return($stmt->execute()?true:false);
			}

		}
	}
}