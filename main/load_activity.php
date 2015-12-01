<?php
    require_once('data.php');
    $activity = new activity();
    $follow = new following();

    $type = $_GET['type'];
    $activity_id = $_GET['activity_id'];
    $user_id = $_GET['user_id'];
    if($type == 0){
        $res_activity = $activity->getOneEvent($activity_id);
        if($res_activity['user_id'] == $user_id){ 
            echo json_encode($res_activity);
            return;
        }
        $res_follow = $follow->isfollowing($activity_id, $user_id);                
        //$res = array_merge($res_activity + $res_follow);
        $res = $res_activity + $res_follow;
        echo json_encode($res);
    }
    else if($type == 1){            //add new follower
        $follow_time = $_GET['follow_time'];
        $follow->addFollower($activity_id, $user_id, $follow_time);  
        $activity->upadateFollow($activity_id);
        $res = $activity->getCurrentFollowNumber($activity_id);
        echo json_encode($res);
    }
    else if($type == 2){            //remove one follower  //activity table number - 1 following table remove follower id
        $follow->removeFollowFromOneEvent($activity_id, $user_id);  
        $activity->removeFollow($activity_id);
        $res = $activity->getCurrentFollowNumber($activity_id);
        echo json_encode($res);
    }
    else if($type == 3){            //retrieve all the images corresponding to certain one activity
        


    }

?>