<?php
session_start();
$title = 'vjoin';
include('../static/header.php');
include('../static/nav.php');
require_once('classes/auth_system.php');

echo '<br/><br/><pre>Session_variable:<br/>';
	var_dump($_SESSION);
echo '</pre>';


// http://localhost/final/authentication/vertify.php?email=909@gmail.com&code=oasANXjFTDedAPl26yI^S10Lo5oVmkZn%H5(iJT$
if(isset($_GET['email'])&&isset($_GET['code'])){
	$user = new AuthSystem();
	if($user->vertifycode($_GET['email'],$_GET['code'])){
		echo "Vertified.";

	}else{
		echo "Bad request.";
		
	}
}

?>

<?php
include('../static/footer.php');
?>