<?php
session_start();
$title = 'vjoin';
include('../static/header.php');
require_once('classes/auth_system.php');
echo '<br/><br/><pre>Session_variable:<br/>';
	var_dump($_SESSION);
echo '</pre>';


if(isset($_POST['last_name'])||
	isset($_POST['first_name'])||
		isset($_POST['address'])||
			isset($_POST['apt'])||
				isset($_POST['city'])||
					isset($_POST['zipcode'])||
						isset($_POST['phone_number'])||
							isset($_POST['introduction'])
){
	// $user = new AuthSystem();
	// $user -> createuser($_POST['email'],$_POST['password']);
	// echo 'Account Created, please check your email for verification information';
	var_dump($_POST);
}	
?>

<form class="form-horizontal" method="POST" action="">

	<fieldset>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="user_last_name">Last name</label>
			<div class="col-md-4">
				<input id="user_last_name" name="last_name" type="text" placeholder="" class="form-control input-md" value="{{ user_info.last_name }}">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="user_first_name">First name</label>
			<div class="col-md-4">
				<input id="user_first_name" name="first_name" type="text" placeholder="" class="form-control input-md " value="{{ user_info.first_name }}">
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="address">Address</label>
			<div class="col-md-4">
				<input id="address" name="address" type="text" placeholder="" class="form-control input-md" value="{{ user_info.address }}">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="address">apt</label>
			<div class="col-md-4">
				<input id="address" name="apt" type="text" placeholder="" class="form-control input-md" value="{{ user_info.address }}">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="user_city">City</label>
			<div class="col-md-4">
				<input id="user_city" name="city" type="text" placeholder="" class="form-control input-md" value="{{ user_info.city }}">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="user_zipcode">Zipcode</label>
			<div class="col-md-4">
				<input id="user_zipcode" name="zipcode" type="text" placeholder="" class="form-control input-md" value="{{ user_info.zipcode }}">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="user_tel">Telphone</label>
			<div class="col-md-4">
				<input id="user_tel" name="phone_number" type="text" placeholder="" class="form-control input-md" value="{{ user_info.phone_number }}">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="user_introduciton">Preference</label>
			<div class="col-md-4">
				<input id="user_introduciton" name="introduction" type="text" placeholder="" class="form-control input-md" value="{{ user_info.introduction }}">
				
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