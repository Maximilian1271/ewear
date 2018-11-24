<?php

namespace App\Libs;

class Validator
{
	private $filters = [
		'text'    => '/^[a-zA-Z]+$/',
		'num'     => '/^[\d]+$/',
		'textnum' => '/^[\w ß]+$/',
		'email'   => '/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/',
		'url'     => '/^http(s)?:\/\/([\w]{1,20}\.)?[a-z0-9-]{2,65}(\.[a-z]{2,10}){1,2}(\/)?$/',
	];

	private $error_msg = [];
	private $name;

	public function val($data = "", $name = '', $required = false, $type = "text", $min = null, $max = null)
	{
		$this->name = $name;

		if ($required && empty($data)) {
			$this->setError(0);
			return false;
		}

		if ($min !== null && strlen($data) < $min) {
			$this->setError(1, $min);
			return false;
		}

		if ($max !== null && strlen($data) > $max) {
			$this->setError(2, $max);
			return false;
		}

		if (array_key_exists($type, $this->filters)) {
			if (! preg_match($this->filters[$type], $data)) {
				$this->setError(3);
				return false;
			}
		}
	}

	public function comp($data1, $data2)
	{
		if (is_array($data1) && is_array($data2)) {
			if ($data1[0] !== $data2[0]) {
				$this->setError(4, [$data1[1], $data2[1]]);
				return false;
			}
		}
	}

	private function setError($error, $opt = null)
	{
		switch ($error) {
			case 0:
				array_push($this->error_msg, "{$this->name} is a required field!");
				break;
			case 1:
				array_push($this->error_msg, "{$this->name} contains too few characters! Min: $opt!");
				break;
			case 2:
				array_push($this->error_msg, "{$this->name} contains too many characters! Max: $opt!");
				break;
			case 3:
				array_push($this->error_msg, "{$this->name} is invalid!");
				break;
			case 4:
				array_push($this->error_msg, "{$opt[0]} and {$opt[1]} need to be the same!");
				break;
			case 5:
				array_push($this->error_msg, "User needs to be activated first");
				break;
			case 6:
				array_push($this->error_msg, "Login data incorrect");
				break;
			case 7:
				array_push($this->error_msg, "Username already set");
				break;
			case 8:
				array_push($this->error_msg, "Email already set");
				break;
			default:
				array_push($this->error_msg, "{$this->name} is invalid");
		}

	}

	public function getErrors($errcode=false)
	{
		if($errcode!=false){
			$this->setError($errcode);
			return $this->error_msg;
		}

		return (count($this->error_msg) > 0) ? $this->error_msg : false;
		return false;
	}
}