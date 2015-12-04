<?php
// Database
$db_connection = array();
$db_connection['host'] = "ec2-54-193-93-188.us-west-1.compute.amazonaws.com";
$db_connection['username'] = "admin"; // Change this to your user
$db_connection['password'] = "vjoin123456"; // randomly generated
$db_connection['database'] = "cs546_final"; // randomly generated
// $db_connection['host'] = "localhost";
// $db_connection['username'] = "root"; // Change this to your user
// $db_connection['password'] = "123"; // randomly generated
// $db_connection['database'] = "final"; // randomly generated
// Timezone
date_default_timezone_set('America/New_York');
//Fully Qualified Domain Name
define("SITE_HTTP", "localhost");
//Return email address
define("FROM_EMAIL", "vjoin@gmail.com");
?>