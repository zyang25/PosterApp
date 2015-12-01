<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/Vjoin/main/data.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Vjoin/PHPmail/mail.php');

class AuthSystem{

	private $site_key;
	private $model;

	function __construct(){
		$site_key = "V2t-#j^ayDH'vG72MMc@XDpg5U30yv";
	}

	function createUser($email, $password){
		$this->model = new UserModel();
		// Hash password
		$cost = 10;
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		$salt = sprintf("$2a$%02d$", $cost) . $salt;
		$hashed_password = crypt($password,$salt);
		// Generate code
		$code = $this->randomString();
		// Create user
		if($this->model->createuser($email,$hashed_password,$salt,$code)){
			//$this->sendVerification($email,$code);
			$gmail = new Gmail();
			$gmail->sendVertifiedEmail($email,urlencode($code));

		}else
			return false;
	}

	public function login($email,$password){
		$this->model = new UserModel();
		$user = $this->model->getuser($email);
		
		if($user != NULL){
				$match = false;
			 	$user_db_password = $user[0]['password'];
			 	if (hash_equals($user_db_password, crypt($password, $user[0]['salt']))) {
		   			$match = true;
				}
			
			if($match == true){
				echo "Password match.";
				if(!isset($_SESSION)){
					session_start();
				}
				// Get user information then store into session
				$userinfo = $this->getuserinfobyuserid($user[0]['id']);
				var_dump($userinfo);

				$_SESSION['user_id'] = $user[0]['id'];
				$_SESSION['email'] = $user[0]['email'];
				$_SESSION['activated'] = $user[0]['activated'];
				$_SESSION['admin'] = $user[0]['admin'];
				$_SESSION['login'] = true;
				$_SESSION['zipcode'] = $userinfo['zip'];
				$_SESSION['preference'] = $userinfo['preference'];

				if($user[0]['admin']==true){
					// Admin user
					return 1;
				}else if($user[0]['activated']==true){
					// Activated user
					return 2;
				}else{
					// Normal user
					return 3;
				}
			}else{
				// Password is not correct
				return -1;
			}
		}else{
			// Email doesn't exist
			return -2;
		}
	}

	public function logout(){
		session_destroy();
	}


	public function vertifycode($email,$code){
		$this->model = new UserModel();
		return $this->model->vertifycode($email,urldecode($code));
	}

	// Password management
	private function randomString($length = 50)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz!@#$%^*()ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$string = '';

		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters) - 1)];
		}

		return $string;
	}

	public function newpassword($email,$user_id){
		$this->model = new UserModel();
		// $random_password = "charles9129";
		$random_password = $this->randomString(8);
		echo $random_password."<br/>";
		$cost = 10;
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		$salt = sprintf("$2a$%02d$", $cost) . $salt;
		$hashed_password = crypt($random_password,$salt);
		echo $hashed_password."<br/>".$salt."<br/>";
		$this->model->changepassword($hashed_password,$salt,$user_id);

		// Send mail
		$gmail = new Gmail();
		$gmail->sendnewpassword($email,$random_password);
	}

	public function checkpassword($email,$password){
		$this->model = new UserModel();
		$user = $this->model->getuser($email);
		if($user != NULL){
			$user_db_password = $user[0]['password'];
		 	if (hash_equals($user_db_password, crypt($password, $user[0]['salt']))) {
		 		return true;
			}else
				return false;
		}
	}

	public function changepassword($email,$org_password,$new_password,$user_id){
		$this->model = new UserModel();
		// echo $org_password."<br/>".$new_password."<br/>";
		$cost = 10;
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		$salt = sprintf("$2a$%02d$", $cost) . $salt;
		$hashed_password = crypt($new_password,$salt);
		
		echo $hashed_password."<br/>".$salt."<br/>";
		$this->model->changepassword($hashed_password,$salt,$user_id);

	}

	// User profile
	public function updateuserinfo($lname,$fname,$address1,$address2,$tel,$zip,$preference,$user_id){
		$this->model = new UserModel();
		$this->model->updateuserinfo($lname,$fname,$address1,$address2,$tel,$zip,$preference,$user_id);
	}

	public function getuserinfo(){
		$this->model = new UserModel();
		$userinfo = $this->model->getuserinfo();
		return $userinfo[0];
	}

	public function getuserinfobyuserid($id){
		$this->model = new UserModel();
		$userinfo = $this->model->getuserinfobyuserid($id);
		return $userinfo[0];
	}

	// Common query
	public function getuser($email){
		$this->model = new UserModel();
		$user = $this->model->getuser($email);
		return $user[0];
	}

}


?>