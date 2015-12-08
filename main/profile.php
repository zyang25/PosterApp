<?php
session_start();
$title = 'vjoin';
require_once('auth_system.php');

echo "<br/><br/><br/><br/>";
$c = new category();
$allc = $c->getAllCategory();
// echo '<br/><br/><pre>Session_variable:<br/>';
// var_dump($_SESSION);
// echo '</pre>';

if($_SESSION['user_id']!=""){
	
	$user = new AuthSystem();
	//Check profile update
	if(isset($_POST['last_name'])||
	isset($_POST['first_name'])||
		isset($_POST['address1'])||
			isset($_POST['address2'])||
					isset($_POST['zipcode'])||
						isset($_POST['phone_number'])||
							isset($_POST['introduction'])
	){
	$user_id = $_SESSION['user_id'];
	
	// Preference
	if(!empty($_POST['introduction'])){
		$preference_array = $_POST['introduction'];
		$result = $_POST['introduction'][0];
	
		for($x = 1; $x < sizeof($preference_array); $x++){
			$result .= ',' . $preference_array[$x] ;
		}

		$_POST['introduction'] = $result;
	}else{
		$_POST['introduction'] = "";
	}

	// Preference update	
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
	// Update session
	$_SESSION['preference'] = $_POST['introduction'];
	
	}

	//If there is nothing post, then get information from database
	$userinfo = $user->getuserinfobyuserid($_SESSION['user_id']);
	
	if($userinfo["preference"]=="")
		$get_preference = [1,2,3];
	else
		$get_preference = explode($userinfo["preference"],',');

	
}else{
	header('Location: ../index.php');
	echo "Login pls.";
}

?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="../assets/css/half-slider.css" rel="stylesheet">
    </head>
    <body>
        <?php
        include("../main/nav.php");
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

		
		<!-- Multiple Checkboxes -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="checkboxes">Preference</label>
		  <div class="col-md-4" style="margin-left: 0.5cm;">
			<?php
		      		foreach ($allc as $key) {

		      			echo '<div class="checkbox">';
		      			echo '<input type="checkbox" name="introduction[]" value="' . $key["category_id"] . '" >';		
						echo $key["category_name"];
						echo "</div>";
					
					}
		    ?>
		  </div>
		</div>


		<div class="form-group">
			<center><button type="submit" id="userinfo_sumit" name="userinfo" class="btn btn-success">Save</button></center>
		</div>
	</fieldset>
</form>

<select multiple>

</select>

<!-- /.container -->

    <!-- jQuery -->
    <script src="../assets/js/jquery-1.11.1.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>

<?php

function process_preference($data){
	$preference = explode($data,',');
	return $preference;
}

?>



