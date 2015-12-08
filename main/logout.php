<?php
session_start();
$title = 'vjoin';

require_once('auth_system.php');



$user = new AuthSystem();
$user->logout();
header('Location: ../index.php');
?>
