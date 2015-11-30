<?php
session_start();
$title = 'vjoin';


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
<img style="margin-top:-10px;width:300px"class="pull-left" src="../assets/img/stevens.png" alt="UAH"/>
<p style="margin:14px 20px 0 0;" class="pull-right">
    <a href="http://www.uah.edu/oit/getting-started/for-students/67-main/its/666-campus-ids" accesskey="H" onclick="popup = window.open('http://www.uah.edu/oit/getting-started/for-students/67-main/its/666-campus-ids', 'PopupPage','height=500,width=450,scrollbars=yes,resizable=yes'); return false" target="_blank" onmouseover="window.status='';  return true" onmouseout="window.status=''; return true" onfocus="window.status='';  return true" onblur="window.status=''; return true" class="submenulinktext2"><i class="fa fa-question-circle"></i> Help</a>  |  
    <a href="bwskalog.p_displogoutnon" accesskey="3" class="submenulinktext2"><i class="fa fa-sign-out"></i> Exit</a></p>
</div>
    <div class="omb_login">

        <div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <h1>Vjoin forgot password</h1>
			  <form role="form" method="post" action="" autocomplete="off">
                <div class="form-group">
                <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="2">
                </div>
                <input type="submit" name="submit" value="Submit" class="btn btn-danger btn-block btn-lg" tabindex="5">
                </form>
			</div>
    	</div>
	</div>
    
    <p class="text-center small"><span class="releasetext">Release: 8.5.1.2</span></p>

</div>
    
</body>
</html>