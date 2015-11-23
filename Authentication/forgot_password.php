<?php
session_start();
$title = 'vjoin';
include('../static/header.php');

require_once('classes/auth_system.php');

echo '<br/><br/><pre>Session_variable:<br/>';
	var_dump($_SESSION);
echo '</pre>';

if(isset($_POST['email'])){

	$user = new AuthSystem();
	
	$user_array = $user->getuser($_POST['email']);
	if($user_array!=""){
		echo $user_array['id'];
		$user->newpassword($user_array['email'],$user_array['id']);
	}else{
		echo "Bad email request.";
	}

}

?>

<form role="form" method="post" action="" autocomplete="off">
	<div class="form-group">
		<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="2">
	</div>
	
	<input type="submit" name="submit" value="Submit" class="btn btn-primary btn-block btn-lg" tabindex="5">
</form>

<?php
include('../static/footer.php');
?>