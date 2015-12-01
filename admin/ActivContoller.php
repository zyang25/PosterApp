<?php
require_once '../main/data.php';
header('content-type:text/json');
header("Cache-Control:no-cache");

$ActivService=new activity();
if(isset($_POST['activity_id'])&&isset($_POST['start_time'])&&isset($_POST['location'])&&isset($_POST['title'])&&isset($_POST['max_followers'])&&isset($_POST['state'])&&isset($_POST['description'])){
    $activity_id=$_POST['activity_id'];
    $start_time=$_POST['start_time'];
    $location=$_POST['location'];
    $title=$_POST['title'];
    $max_followers=$_POST['max_followers'];
    $state=$_POST['state'];
    $description=$_POST['description'];

    $ActivService->Update($start_time, $location, $title,$max_followers,$state, $description, $activity_id);
    $updatedData=$ActivService->getActivById($activity_id);

    echo json_encode($updatedData);
}
else if(isset($_POST['activity_id'])){
    $activity_id=$_POST['activity_id'];

    $originalData=$ActivService-> getActivById($activity_id);

    echo json_encode($originalData);
}
?>