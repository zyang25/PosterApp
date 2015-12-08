<?php
session_start();
$title = 'vjoin';
require_once('auth_system.php');


if(isset($_POST['email'])&&isset($_POST['password'])){
$user = new AuthSystem();

if($user -> createuser($_POST['email'],$_POST['password'])){
    echo "<div class=\"alert alert-success\" role=\"alert\">";
    echo "Account Created, please check your email for verification information";
    echo "<a href=\"../index.php\" accesskey=\"3\" class=\"submenulinktext2\"><i class=\"fa fa-sign-out\"></i> Exit</a></p>";
    echo "</div>";
}else{
    echo "<div class=\"alert alert-danger\" role=\"alert\">";
    echo "The username is already existed";
    echo "<a href=\"../index.php\" accesskey=\"3\" class=\"submenulinktext2\"><i class=\"fa fa-sign-out\"></i> Exit</a></p>";
    echo "</div>";
}

}

?>
<!DOCTYPE html>
<html lang="en">

<head>   
<!-- CSS -->
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/omb.css">
        
</head>
<body>
<div class="container">
    
<div class="row">
<img style="margin-top:-10px;width:300px;"class="pull-left" src="../assets/img/stevens.png" alt="UAH"/>
</div>
    <div class="omb_login">

        <div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <h1>Vjoin SignUp</h1>
			   <form role="form" method="post" action="" autocomplete="off" id="register_form">
                    <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="2" required>
                    <span id="email_error"></span>
                    </div>
                    <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3" required>
                    </div>
                    <div class="form-group">
                    <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="4" required>
                    </div>
                    <input type="submit" name="submit" value="Register" class="btn btn-danger btn-block btn-lg" tabindex="5">
                    <span id="password_error"></span>
                    </form>
			</div>
    	</div>
	</div>
    <p class="text-center small"><span class="releasetext">Release: 8.5.1.2</span></p>

</div>
    <!-- Javascript -->
    <script src="../assets/js/jquery-1.11.1.min.js"></script>
    <script>
        function check_email(){
        var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        var stevens_email = /^\w+@(stevens.edu)$/;
        var email = document.getElementById("email").value;
        var r = stevens_email.test(email);
        document.getElementById("email_error").innerHTML = "Please use Stevens edu email.";
        console.log(r);
        if (r==true){
            document.getElementById("email_error").innerHTML = "";
        }
        return r;
    };
    function check_password(){
        var password1 = document.getElementById("password").value;
        var password2 = document.getElementById("passwordConfirm").value;
        if(password1.length<6||password2.length<6){
            document.getElementById("password_error").innerHTML = "Password's length should be longer than 6.";
            return false;
        }else if(password1 != password2){
            document.getElementById("password_error").innerHTML = "Password does not match.";
            return false;
        }else{
            document.getElementById("password_error").innerHTML = "";
            return true;
        }
    };

    $('#register_form').bind("submit",function(e){
        if(check_password()){
            $(this).unbind('submit').submit();
        }else{
            e.preventDefault();
        }
    });
    </script>

</body>
</html>