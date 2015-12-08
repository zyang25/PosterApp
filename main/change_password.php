<?php
session_start();
$title = 'vjoin';
require_once('auth_system.php');

if( !isset($_SESSION['user_id']) || $_SESSION['user_id']=="" ){
    header('Location: ../index.php');
}


if(isset($_POST['org_password'])
&&isset($_POST['new_password'])
&&isset($_POST['confirm_password'])
){
$user = new AuthSystem();
if($user->checkpassword($_SESSION['email'],$_POST['org_password'])){
    // Why I have to user another object.
    $user1 = new AuthSystem();
    $user1->changepassword($_SESSION['email'],$_POST['org_password'],$_POST['new_password'],$_SESSION['user_id']);
    $user->logout();
    header("Location: ../index.php");
}else{
    $help = "Password doesn't match in your record";
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
                    <a href="../index.php" accesskey="3" class="submenulinktext2"><i class="fa fa-sign-out"></i> Exit</a></p>
                </div>
                <div class="omb_login">
                    <div class="row omb_row-sm-offset-3">
                        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                            <h1>Vjoin Change password</h1>
                            <form role="form" method="post" action="" autocomplete="off" id="changepassword_form">
                                <div class="form-group">
                                    <input type="password" name="org_password" id="password1" class="form-control input-lg" placeholder="Old password" tabindex="3" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="new_password" id="passwordConfirm" class="form-control input-lg" placeholder="New password" tabindex="3" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm_password" id="password" class="form-control input-lg" placeholder="Confirmed password" tabindex="3" required>
                                    <span><?php if(isset($help)){echo $help;}?></span>
                                    <span id="password_error"></span>
                                </div>
                                <input type="submit" name="submit" value="Change" class="btn btn-danger btn-block btn-lg" tabindex="5">
                                
                            </form>
                        </div>
                    </div>
                </div>
                
                <p class="text-center small"><span class="releasetext">Release: 8.5.1.2</span></p>
            </div>
        <!-- jQuery -->
    <script src="../assets/js/jquery-1.11.1.js"></script>
        <script type="text/javascript">
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
            $('#changepassword_form').bind("submit",function(e){
                if(check_password()){
                    $(this).unbind('submit').submit();
                }else{
                    e.preventDefault();
                }
            });
        </script>
        </body>
    </html>