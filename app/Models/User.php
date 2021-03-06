<?php

namespace App\Models;

use App\Core\Model;

class User extends Model {
	protected $table_name = "users";

	public function setUser($uname, $email, $password, $name, $surname, $address, $zip, $newsletter){
		$user_group = 1;
		$created_at = time();
		$data = [
			'name'=> $name,
			'surname' => $surname,
			'address'=> $address,
			'zip' => $zip
		];
		$data = json_encode($data);
		$hash = uniqid();
		$is_active = 1;

		$salt = $this->generateSalt();
		$pw = sha1($password . $salt) . ":" . $salt;

		$stmt = $this->db->prepare("INSERT INTO {$this->table_name} (uname, email, password, data, roles_fs, hash, is_active, created_at, newsletter) Values (?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("ssssisiii",$uname, $email, $pw, $data, $user_group, $hash, $is_active, $created_at, $newsletter);
		$stmt->execute();
		$cart=new Cart();
		$cart->createCart($stmt->insert_id);
		return $hash;
	}
	public function getUserByUname($username){
		$res = $this->db->query("SELECT * FROM {$this->table_name} WHERE uname ='$username'");
		$account = $res->fetch_assoc();
		return $account;
	}
	private function generateSalt(){
		return rand (1000,9999);
	}

	public function setActiveStatus($status = 1){
		$stmt=$this->db->prepare("UPDATE {$this->table_name} SET is_active=?");
		$stmt->bind_param("i", $status);
		$stmt->execute();
	}

	public function checkActiveStatusByHash($hash = null){
		$res = $this->db->query("SELECT is_active FROM {$this->table_name} WHERE hash = '$hash' LIMIT 1");
		if ($res->num_rows > 0 ) {
			$row = $res->fetch_assoc();
			return $row['is_active'];
		}else {
			return false;
		}
	}
	public function checkUname($uname=null){
		if($uname!=null){
			if($this->db->query("SELECT id FROM {$this->table_name} WHERE uname='$uname' LIMIT 1")->num_rows==1){
				return true;
			}else return false;
		}
	}
	public function checkEmail($email){
		if($email!=null){
			if($this->db->query("SELECT id FROM {$this->table_name} WHERE email='$email' LIMIT 1")->num_rows==1){
				return true;
			}else return false;
		}
	}
	public function getUserbyId($id=null){
		if ($id!=null){
			$res=$this->db->query("SELECT users.*,roles.Role FROM {$this->table_name} LEFT JOIN roles ON users.roles_fs=roles.id WHERE users.id=$id");

			if ($res->num_rows>0){
				return $res->fetch_assoc();
			}
			else return false;
		}
	}
	public function updateUserById($id=null, $data){
		if ($id!=null){
			$user_data=[
				"name"=> $data['name'],
				"surname"=>$data['surname'],
				"address"=>$data['address'],
				"zip"=>$data['zip']
			];
			$user_data=json_encode($user_data);
			if (isset($data['uname'])&&isset($data['email'])){
				$stmt=$this->db->prepare("UPDATE {$this->table_name} SET email=?, uname=?, data=? WHERE id=$id");
				$stmt->bind_param("sss", $data['email'], $data['uname'], $user_data);
				$stmt->execute();
				return true;
			}
			else{
				$stmt=$this->db->prepare("UPDATE {$this->table_name} SET data=? WHERE id=$id");
				$stmt->bind_param("s", $user_data);
				$stmt->execute();
				if(!empty($data['pw'])){
					$salt = $this->generateSalt();
					$pw = sha1($data['pw'] . $salt) . ":" . $salt;
					$stmt=$this->db->prepare("UPDATE {$this->table_name} SET data=?, password=? WHERE id=$id");
					$stmt->bind_param("ss", $user_data, $pw);
					$stmt->execute();
					return true;
				}
				return true;
			}

		}
	}
	public function delUserById($id=null){
		if ($id!=null){
			$this->db->query("DELETE FROM {$this->table_name} WHERE id=$id");
			return true;
		}
	}
	public function checkLock($id){
		$res=$this->db->query("SELECT locked FROM {$this->table_name} WHERE id=$id")->fetch_row();
		return $res[0];
	}
	public function getAll(){
		$res=$this->db->query("SELECT * FROM {$this->table_name}")->fetch_all(MYSQLI_ASSOC);
		return $res;
	}
	public function lockUserById($id){
		$this->db->query("UPDATE {$this->table_name} SET locked=1 WHERE id=$id");
		return true;
	}
	public function unlockUserById($id){
		$this->db->query("UPDATE {$this->table_name} SET locked=0 WHERE id=$id");
		return true;
	}
	public function getRoles(){
		return $this->db->query("SELECT Role, id FROM roles")->fetch_all(MYSQLI_ASSOC);
	}
}