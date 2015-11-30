<?php

require 'PHPMailerAutoload.php';

// $mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

// $mail->isSMTP();                                      // Set mailer to use SMTP
// $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
// $mail->SMTPAuth = true;                               // Enable SMTP authentication
// $mail->Username = 'vjoin.stevens@gmail.com';                 // SMTP username
// $mail->Password = 'charles9129';                           // SMTP password
// $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
// $mail->Port = 587;                                    // TCP port to connect to

// $mail->setFrom('vjoin.stevens@gmail.com', 'Mailer');
//$mail->addAddress('vjoin.stevens@gmail.com', '');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//$mail->isHTML(true);                                  // Set email format to HTML

//$mail->Subject = 'Thank you for registeration';
// $mail->Body    = '

// Dear sir/madam,<br/><br/>'.

// 'Vjoin received a request to create an account for you. To verify your account, please click the following link:<br/>' . 

// 'Best regards,<br/>' .
// 'The Team at Vjoin<br/>';


// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

// if(!$mail->send()) {
//     echo 'Message could not be sent.';
//     echo 'Mailer Error: ' . $mail->ErrorInfo;
// } else {
//     echo 'Message has been sent';
// }

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

		$this->mail->setFrom('vjoin.stevens@gmail.com', 'Mailer');
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