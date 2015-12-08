<?php
session_start();
$title = 'vjoin';

require_once('classes/auth_system.php');

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

<div class="row">
	<?php

	if(isset($_GET['email'])&&isset($_GET['code'])){

		$user = new AuthSystem();
		if($user->vertifycode($_GET['email'],$_GET['code'])){
			echo "<center>";
			echo "<h2>Vertified.<h2>";
			echo "</center>";

		}else{
			echo "Bad request.";
			
		}
	}
?>
</div>
    

</div>
    <!-- Javascript -->
    <script src="../assets/js/jquery-1.11.1.min.js"></script>
    

</body>
</html>