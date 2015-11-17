<?php
session_start();
$title = 'vjoin';
include('../static/header.php');
require_once('classes/auth_system.php');

echo '<br/><br/><pre>Session_variable:<br/>';
	var_dump($_SESSION);
echo '</pre>';

$user = new AuthSystem();
$user->logout();

?>

<?php
include('../static/footer.php');
?>