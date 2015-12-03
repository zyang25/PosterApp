<?php
session_start();
require_once('data.php');

$activity = new activity();



if(is_ajax()){
	query_activity();
}

function query_activity(){

	
	if(isset($_GET['category_id']) && isset($_GET['current_activity_number']) && !empty($_GET['category_id'])){
		
		global $activity;
		
		$category_id = $_GET['category_id'];
		$offset = $_GET['current_activity_number'];
		
		$activity_query_array = $activity->getMoreActivityByCategoryId($_SESSION['user_id'],$category_id, $offset);
		
		//var_dump($activity_query_array);
		echo json_encode($activity_query_array);
  		//echo json_encode($return);
	}else if(isset($_GET['category_id']) && !empty($_GET['category_id'])){
		global $activity;
		
		$category_id = $_GET['category_id'];
		
		$activity_query_array = $activity->getActivityByCategoryId($_SESSION['user_id'],$category_id);
		
		//var_dump($activity_query_array);
		echo json_encode($activity_query_array);
  		//echo json_encode($return);
	}
}



// Check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}


?>