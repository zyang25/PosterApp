<?php

require 'PHPMailerAutoload.php';

class Gmail{
	
	private $mail;
	
	function __construct(){
		
		$this->mail = new PHPMailer;
		$this->mail->isSMTP();                                      // Set mailer to use SMTP
		$this->mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$this->mail->SMTPAuth = true;                               // Enable SMTP authentication
		$this->mail->Username = 'vjoin.stevens@gmail.com';                 // SMTP username
		$this->mail->Password = 'charles9129';                           // SMTP password
		$this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$this->mail->Port = 587;                                    // TCP port to connect to

		$this->mail->setFrom('vjoin.stevens@gmail.com', 'Vjoin Team');
		$this->mail->isHTML(true);                                  // Set email format to HTML
	}

	function sendVertifiedEmail($email,$code){

		$this->mail->addAddress($email);     // Add a recipient
		$message_code = '<br /><br />You can click <a href="http://' . SITE_HTTP . '/vjoin/Authentication/vertify.php?email=' . $email . '&code=' . $code . '">here</a> to verify automatically';
		$this->mail->Subject = 'Thank you for registeration';
		$this->mail->Body    = '
		
		Dear sir/madam,<br/><br/>'.

		'Vjoin received a request to create an account for you. To verify your account, please click the following link:<br/><br/><br/>' . 

		$message_code . '<br/><br/>' .

		'Best regards,<br/>' .
		'The Team at Vjoin<br/>';
		
		if(!$this->mail->send()) {
		    return false;
		} else {
		    return true;
		}
	
	}

	public function sendnewpassword($email,$password) {
		
		$this->mail->addAddress($email);     // Add a recipient
		//set email subject
		$this->mail->Subject = 'Thank you for registeration';

		$this->mail->Body = "This is the new password for your account<br/><br/>Password:  <br/><br/><br/>".$password;

		//send email
		if(!$this->mail->send()) {
		    return false;
		} else {
		    return true;
		}
	}
}