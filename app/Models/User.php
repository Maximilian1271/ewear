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
		$is_active = 0;

		$salt = $this->generateSalt();
		$pw = sha1($password . $salt) . ":" . $salt;

		$stmt = $this->db->prepare("INSERT INTO {$this->table_name} (uname, email, password, data, roles_fs, hash, is_active, created_at, newsletter) Values (?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("ssssisiii",$uname, $email, $pw, $data, $user_group, $hash, $is_active, $created_at, $newsletter);
		$stmt->execute();
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
		$this->db->query("UPDATE {$this->table_name} SET is_active = $status");
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
				$this->db->query("UPDATE {$this->table_name} SET email='{$data['email']}',uname='{$data['uname']}', data='$user_data' WHERE id=$id");
				return true;
			}
			else{
				$this->db->query("UPDATE {$this->table_name} SET data='$user_data' WHERE id=$id");
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
		$res=$this->db->query("UPDATE {$this->table_name} SET locked=1 WHERE id=$id");
		return true;
	}
	public function unlockUserById($id){
		$res=$this->db->query("UPDATE {$this->table_name} SET locked=0 WHERE id=$id");
		return true;
	}
	public function getRoles(){
		return $this->db->query("SELECT Role, id FROM roles")->fetch_all(MYSQLI_ASSOC);
	}
}