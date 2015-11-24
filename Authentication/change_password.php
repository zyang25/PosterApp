<?php
session_start();
$title = 'vjoin';

require_once('classes/auth_system.php');

echo '<br/><br/><pre>Session_variable:<br/>';
	var_dump($_SESSION);
echo '</pre>';


if(isset($_POST['org_password'])
	&&isset($_POST['new_password'])
	&&isset($_POST['confirm_password'])
){
	$user = new AuthSystem();
	if($user->checkpassword($_SESSION['email'],$_POST['org_password'])){
		echo "password correct";
		// Why I have to user another object.
		$user1 = new AuthSystem();
		$user1->changepassword($_SESSION['email'],$_POST['org_password'],$_POST['new_password'],$_SESSION['user_id']);
	}
}
?>
<form role="form" method="post" action="" autocomplete="off">
	
	<div class="form-group">
		<input type="password" name="org_password" id="password" class="form-control input-lg" placeholder="Old password" tabindex="3">
	</div>
	<div class="form-group">
		<input type="password" name="new_password" id="password" class="form-control input-lg" placeholder="New password" tabindex="3">
	</div>
	<div class="form-group">
		<input type="password" name="confirm_password" id="password" class="form-control input-lg" placeholder="Confirmed password" tabindex="3">
	</div>
	
	<input type="submit" name="change_password_submit" value="Change" class="btn btn-primary btn-block btn-lg" tabindex="5">
</form>