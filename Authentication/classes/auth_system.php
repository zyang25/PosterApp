<?php
require_once 'user_model.php';

class AuthSystem{

	private $site_key;
	private $model;

	function __construct(){
		$site_key = "V2t-#j^ayDH'vG72MMc@XDpg5U30yv";
		$this->model = new UserModel();
	}

	function createUser($email, $password){

		// Hash password
		$cost = 10;
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		$salt = sprintf("$2a$%02d$", $cost) . $salt;
		$hashed_password = crypt($password,$salt);
		// Generate code
		$code = $this->randomString();
		// Create user

		if($this->model->createuser($email,$hashed_password,$salt,$code)){
			$this->sendVerification($email,$code);
		}else
			return false;
	}

	public function login($email,$password){

		$user = $this->model->getuser($email);
		if($user != NULL){
				$match = false;
			 	$user_db_password = $user[0]['password'];
			 	if (hash_equals($user_db_password, crypt($password, $user[0]['salt']))) {
		   			$match = true;
				}
			
			if($match == true){

				if(!isset($_SESSION)){
					session_start();
				}
				$_SESSION['user_id'] = $user[0]['id'];
				$_SESSION['email'] = $user[0]['email'];
				$_SESSION['activated'] = $user[0]['activated'];
				$_SESSION['admin'] = $user[0]['admin'];
				$_SESSION['login'] = true;

				if($user[0]['admin']==true){

					// Admin user
					return 1;
				}else if($user[0]['activated']==true){
					// Activated user

					return 2;
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
		return $this->model->vertifycode($email,$code);
	}

	public function sendVerification($email, $code) {
		
		//set email subject
		$subject = 'Account Creation Verification';

		$message = 'This is to verify your new account has a valid email address';
		$message .= '<br /><br />You can click <a href="http://' . SITE_HTTP . '/final/Authentication/vertify.php?email=' . $email . '&code=' . $code . '">here</a> to verify automatically';
		$message .= '<br /><br />Thank you for your coorperation';

		//set email headers
		$headers = 'From: ' . FROM_EMAIL . "\r\n" .
		    'Reply-To: ' . FROM_EMAIL . "\r\n" .
			'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
		    'X-Mailer: PHP/' . phpversion();


		//send email
		if (mail($email, $subject, $message, $headers)) {
			return true;
		}

		return false;
	}

	private function randomString($length = 50)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz!@#$%^*()ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$string = '';

		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters) - 1)];
		}

		return $string;
	}

	// User profile
	public function updateuserinfo($lname,$fname,$address1,$address2,$tel,$zip,$preference,$user_id){
		$this->model->updateuserinfo($lname,$fname,$address1,$address2,$tel,$zip,$preference,$user_id);
	}

	public function getuserinfo(){
		$userinfo = $this->model->getuserinfo();
		return $userinfo[0];
		// var_dump($userinfo[0]);
	}

}


?>