<?php
session_start();
$title = 'vjoin';
include('../static/header.php');
require_once('classes/auth_system.php');

echo '<br/><br/><pre>Session_variable:<br/>';
	var_dump($_SESSION);
echo '</pre>';

if(isset($_POST['email'])&&isset($_POST['password'])){
	$user = new AuthSystem();
	$user -> createuser($_POST['email'],$_POST['password']);
	echo 'Account Created, please check your email for verification information';
}

?>
<form role="form" method="post" action="" autocomplete="off">
	<div class="form-group">
		<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="2">
	</div>
	<div class="form-group">
		<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
	</div>
	<div class="form-group">
		<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="4">
	</div>
	
	<input type="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="5">
</form>
<?php
include('../static/footer.php');
?>