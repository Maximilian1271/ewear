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
	public function addProduct($data=array(), $files=array()){
		if($data>0){
			if($files>0){
				$cat=1;
				$colour=json_encode(["colour"=>"red"]);
				$img=$this->targetFolder.$files['img']['name'];
				move_uploaded_file($files['img']['tmp_name'], $img);
				$stmt=$this->db->prepare("INSERT INTO $this->table_name ('title', 'product_desc', 'product_desc_long', 'base_price', 'image', 'created_at', 'in_stock', 'data', 'category_fs') VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$stmt->bind_param("sssisiisi", $data['title'], $data['desc'], $data['longDesc'], $data['baseprice'], $files['img']['name'], $time, $data['stock'], $colour, $cat);
				$stmt->execute();
			}

		}
	}
}