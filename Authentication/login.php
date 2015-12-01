<?php
session_start();
$title = 'vjoin';
include('../assets/header.php');
require_once('classes/auth_system.php');

echo '<br/><br/><pre>Session_variable:<br/>';
	var_dump($_SESSION);
echo '</pre>';

if(isset($_POST['email'])&&isset($_POST['password'])){
	$user = new AuthSystem();
	$status = $user -> login($_POST['email'],$_POST['password']);
	echo "Status: ".$status."<br/>";
	if($status == 1 || $status == 2 || $status == 3){
		echo "Login successfully";
	}else{
		echo "Email or password is not correct.";
	}
}
?>
<form role="form" method="post" action="" autocomplete="off">
	<div class="form-group">
		<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="2">
	</div>
	<div class="form-group">
		<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
	</div>
	
	<input type="submit" name="login" value="Login" class="btn btn-primary btn-block btn-lg" tabindex="5">
</form>
<?php
include('../static/footer.php');
?>