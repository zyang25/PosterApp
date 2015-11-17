<?php
session_start();
$title = 'vjoin';
include('../static/header.php');
require_once('classes/auth_system.php');
echo '<br/><br/><pre>Session_variable:<br/>';
	var_dump($_SESSION);
echo '</pre>';
if($_SESSION['user_id']!=""){
	
	$user = new AuthSystem();
	// Check profile update
	if(isset($_POST['last_name'])||
	isset($_POST['first_name'])||
		isset($_POST['address1'])||
			isset($_POST['address2'])||
					isset($_POST['zipcode'])||
						isset($_POST['phone_number'])||
							isset($_POST['introduction'])
	){
	
	$user_id = $_SESSION['user_id'];
	$user->updateuserinfo(
		$_POST['last_name'],
		$_POST['first_name'],
		$_POST['address1'],
		$_POST['address2'],
		$_POST['zipcode'],
		$_POST['phone_number'],
		$_POST['introduction'],
		$user_id
	);
	// var_dump($_POST);
	}

	$userinfo = $user->getuserinfo();
}else{
	echo "Login pls.";
}
	
?>
<form class="form-horizontal" method="POST" action="">
	<fieldset>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="user_last_name">Last name</label>
			<div class="col-md-4">
				<input id="user_last_name" name="last_name" type="text" placeholder="" class="form-control input-md" value="<?php echo $userinfo["lname"] ?>">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="user_first_name">First name</label>
			<div class="col-md-4">
				<input id="user_first_name" name="first_name" type="text" placeholder="" class="form-control input-md " value="<?php echo $userinfo["fname"] ?>">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="address">Address1</label>
			<div class="col-md-4">
				<input id="address" name="address1" type="text" placeholder="" class="form-control input-md" value="<?php echo $userinfo["address1"] ?>">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="address">Address2</label>
			<div class="col-md-4">
				<input id="address" name="address2" type="text" placeholder="" class="form-control input-md" value="<?php echo $userinfo["address2"] ?>">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="user_zipcode">Zipcode</label>
			<div class="col-md-4">
				<input id="user_zipcode" name="zipcode" type="text" placeholder="" class="form-control input-md" value="<?php echo $userinfo["zip"] ?>">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="user_tel">Telphone</label>
			<div class="col-md-4">
				<input id="user_tel" name="phone_number" type="text" placeholder="" class="form-control input-md" value="<?php echo $userinfo["tel"] ?>">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="user_introduciton">Preference</label>
			<div class="col-md-4">
				<input id="user_introduciton" name="introduction" type="text" placeholder="" class="form-control input-md" value="<?php echo $userinfo["preference"] ?>">
				
			</div>
		</div>
		<div class="form-group">
			<center><button type="submit" id="userinfo_sumit" name="userinfo" class="btn btn-success">Save</button></center>
		</div>
	</fieldset>
</form>
<?php

include('../static/footer.php');
?>