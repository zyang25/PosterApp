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
	
	<input type="submit" id="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="5">
</form>

<?php
include('../static/footer.php');
?>

<script>
	function check_email(){
		var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
		var stevens_email = /^\w+@(stevens.edu)$/;
    	var email = document.getElementById("email").value;
    	var r = stevens_email.test(email);
    	console.log(r);
    };
    function check_password(){
    	var password1 = document.getElementById("password").value;
    	var password2 = document.getElementById("passwordConfirm").value;
    	if(password1.length<6||password2.length<6){
    		alert("Password invalid");
    	}else if(password1 != password2){

    	}
    };
    function check(e){
    	e.preventDefault();
    	//check_email();
    	check_password();
    }
    // document.getElementById("submit").addEventListener("click", function(e){
    // 	e.preventDefault();
    // 	check_email();
    // 	//setTimeout(function(){check_email()}, 3000);
    // });
	document.getElementById("submit").addEventListener("click",check);

    
</script>