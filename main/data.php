<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/Vjoin/connection.php');

    $dbConnection;
    class activity
    {
        private $addActiv;
        private $deleteActiv;
        private $updateFollower;
        private $removeFollow;
        private $getCurrentFollowerNumber;
        //private $retrieveAll;   //retrieve all 
        private $retrieveCate;  //get back all info depend on category
        //private $retrieveOne;   //one event
        private $retriveUnVerify;
        private $getPartInfo;
        private $updateActivity;

        public function addEvent($start_time, $location, $description, $image, $user_id, $category_id, $max_followers, $title) {    //state, following number    
            $follower = 0;
            $state = 0;
            $this->addActiv->bind_param("ssssiiiisi", $start_time, $location, $description, $image, $user_id, $category_id, $follower, $max_followers, $title, $state);
            $this->addActiv->execute();   
        }
        public function deleteEvent($activity_id){
            $this->deleteActiv->bind_param("i", $activity_id);
            $this->deleteActiv->execute();
        }

        public function upadateFollow($activity_id){
            $this->updateFollower->bind_param("i", $activity_id);
            $this->updateFollower->execute();
        }

        public function getCurrentFollowNumber($activity_id){
            $res = array(); 
            $this->getCurrentFollowerNumber->bind_param("i", $activity_id);
            $this->getCurrentFollowerNumber->execute();    
            $this->getCurrentFollowerNumber->bind_result($followers, $max_followers);
            while($this->getCurrentFollowerNumber->fetch()){
                $newTuple = array("followers" => $followers, "max_followers" => $max_followers);
                array_push($res, $newTuple);
            }
            return $res[0];
        }

        public function removeFollow($activity_id){
            $this->removeFollow->bind_param("i", $activity_id);
            $this->removeFollow->execute();
        }
        public function getOneImage($activity_id){
            global $dbConnection;
            return $dbConnection->send_sql("SELECT `image` FROM `activities` WHERE `activity_id` = $activity_id ")->fetch_all(MYSQLI_ASSOC)[0];
        }

        public function getAllEvent(){
            // $res = array();
            // $this->retrieveAll->execute();
            // $this->retrieveAll->bind_result($activity_id, $start_time, $location, $description, $image, $user_id, $category_id, $followers, $max_followers, $title, $state);
            // while($this->retrieveAll->fetch()){
            //     $newTuple = array("activity_id" => $activity_id, "start_time" => $start_time, "location" => $location, "description" => $description, "image" => $image, "user_id" => $user_id, "category_id" =>  $category_id, "followers" => $followers, "max_followers" => $max_followers, "title" => $title, "state" => $state);
            //     array_push($res, $newTuple);               
            // }  
            global $dbConnection;         
            return $dbConnection->send_sql("SELECT * FROM `activities`")->fetch_all(MYSQLI_ASSOC);
        }
        public function getCategory($category_id){
            $res = array();            
            $this->retrieveCate->bind_param("i", $category_id);
            $this->retrieveCate->execute();
            $this->retrieveCate->bind_result($activity_id, $start_time, $location, $description, $image, $user_id, $followers, $max_followers, $title, $state);
            while($this->retrieveCate->fetch()){
                $newTuple = array("$activity_id" => $activity_id, "start_time" => $start_time, "location" => $location, "description" => $description, "image" => $image, "user_id" => $user_id, "followers" => $followers, "max_followers" => $max_followers, "title" => $title, "state" => $state);
                array_push($res, $newTuple);
            }
            return $res;
        }
        public function updateEvent($activity_id, $title, $description, $location, $max_followers){
            global $dbConnection;       
            $query = "UPDATE activities SET title='$title', description='$description',location='$location', max_followers='$max_followers' WHERE activity_id ='$activity_id'";
            $dbConnection->send_sql($query);
        }
        public function getOneEvent($activity_id){
            global $dbConnection;
            return $dbConnection->send_sql("SELECT * FROM `activities` WHERE `activity_id` = $activity_id ")->fetch_all(MYSQLI_ASSOC)[0];

            // $res = array();            
            // $this->retrieveOne->bind_param("i", $activity_id);
            // $this->retrieveOne->execute();
            // $this->retrieveOne->bind_result($activity_id, $start_time, $location, $description, $image, $user_id, $category_id, $followers, $max_followers, $title, $state);
            // while($this->retrieveOne->fetch()){
            //     $newTuple = array("activity_id" => $activity_id, "start_time" => $start_time, "location" => $location, "description" => $description, "image" => $image, "user_id" => $user_id, "category_id" =>  $category_id, "followers" => $followers, "max_followers" => $max_followers, "title" => $title, "state" => $state);
            //     array_push($res, $newTuple);
            // }
            // return $res[0]; 
        }
        public function getUnVerify(){
            $res = array();            
            $this->retriveUnVerify->execute();
            $this->retriveUnVerify->bind_result($activity_id, $start_time, $location, $description, $image, $user_id, $category_id, $followers, $max_followers, $title);
            while($this->retriveUnVerify->fetch()){
                $newTuple = array("activity_id" => $activity_id, "start_time" => $start_time, "location" => $location, "description" => $description, "image" => $image, "user_id" => $user_id, "category_id" =>  $category_id, "followers" => $followers, "max_followers" => $max_followers, "title" => $title);
                array_push($res, $newTuple);
            }
            return $res; 
        }
        public function Paging(&$paging){
            global $dbConnection;
            $row=$dbConnection->send_sql("SELECT COUNT(`activity_id`) FROM `activities`")->fetch_all(MYSQLI_NUM);
            $paging->rowCount=$row[0][0];
            $paging->pageCount=ceil($paging->rowCount/$paging->pageSize);
            $sql="SELECT * FROM `activities` LIMIT ".($paging->pageNow-1)*$paging->pageSize.",$paging->pageSize";
            return $dbConnection->send_sql($sql)->fetch_all(MYSQLI_ASSOC);
        }
        
        public function Update($start_time,$location,$title,$max_followers,$state,$description,$activity_id){
            $this->updateActivity->bind_param("ssssssi",$start_time, $location,$title,$max_followers,$state,$description,$activity_id);
            $this->updateActivity->execute();
        }
        
        public function getActivById($Activity_id){
            $res = array();
            $activity_id=null;
            $start_time=null;
            $location=null;
            $title=null;
            $max_followers=null;
            $state=null;
            $description=null;
            $this->getPartInfo->bind_param("i", $Activity_id);
            $this->getPartInfo->execute();
            $this->getPartInfo->bind_result($activity_id,$start_time, $location,$title,$max_followers,$state,$description);
            while($this->getPartInfo->fetch()){
                $newTuple = array("activity_id"=>$activity_id,"start_time" => $start_time, "location" => $location,"title" => $title,"max_followers"=>$max_followers,"state" => $state,"description" => $description);
                array_push($res, $newTuple);
            }
            return $res;
            
        }

        // main/index.php query activity
        public function getActivityByCategory($user_id, $category_combined_id){
            global $dbConnection;
            if($category_combined_id != ""){
                $category_id = explode(",",$category_combined_id);
                $first = 1;
                $query_combined = "";
                foreach ($category_id as $id) {
                    //$query = "SELECT * FROM activities where category_id = 1 or category_id = 2 order by activity_id DESC limit 5";                  
                    if($first == 1){
                        $query_combined .= "category_id = '$id'";
                        $first = 0;
                    }else{
                        $query_combined .= " or " . "category_id = '$id'";
                    }
                }
                $query = "SELECT * FROM activities where activity_id not in (SELECT activity_id FROM following where user_id = '$user_id') and state = 1 and (" . $query_combined . ") order by activity_id DESC limit 5";
                //echo "<br/><br/>";
                $activities_array = $dbConnection->send_sql($query)->fetch_all(MYSQLI_ASSOC);
                return $activities_array;
            }else{
                $query = "SELECT * FROM activities where activity_id not in (SELECT activity_id FROM following where user_id = '$user_id') and state = 1 order by activity_id DESC limit 5";
                $activities_array = $dbConnection->send_sql($query)->fetch_all(MYSQLI_ASSOC);
                return $activities_array;
            }
            
        }
        
        public function getActivityByUserId($user_id){
            global $dbConnection;
            $query = "SELECT * FROM activities where user_id ='$user_id' ";
            $activities_array = $dbConnection->send_sql($query)->fetch_all(MYSQLI_ASSOC);
            return $activities_array;
        }

        public function getActivityByCategoryId($user_id, $category_id){
            
            global $dbConnection;

            if($category_id!=0){
                $query = "SELECT * FROM activities where activity_id not in (SELECT activity_id FROM following where user_id = '$user_id') and state = 1 and category_id = '$category_id' order by activity_id DESC limit 6";
            }
            else{
                $query = "SELECT * FROM activities where activity_id not in (SELECT activity_id FROM following where user_id = '$user_id') and state = 1 order by activity_id DESC limit 6";
            }
            
            $activities_array = $dbConnection->send_sql($query)->fetch_all(MYSQLI_ASSOC);
            return $activities_array;
            
        }

        public function getMoreActivityByCategoryId($user_id, $category_id, $offset){
            
            global $dbConnection;

            if($category_id!=0){
                $query = "SELECT * FROM activities where activity_id not in (SELECT activity_id FROM following where user_id = '$user_id') and state = 1 and category_id = '$category_id' order by activity_id DESC limit 6 offset ".$offset;
            }
            else{
                $query = "SELECT * FROM activities where activity_id not in (SELECT activity_id FROM following where user_id = '$user_id') and state = 1 order by activity_id DESC limit 6 offset ".$offset;
            }
            
            //echo "<br/><br/><br/>".$query;
            $activities_array = $dbConnection->send_sql($query)->fetch_all(MYSQLI_ASSOC);
            return $activities_array;
            
        }

        public function __construct ()
        {   
            global $dbConnection;
            if($dbConnection == null) $dbConnection = new DatabaseConnection();
        

            $this->addActiv = $dbConnection->prepare_statement("INSERT INTO `activities`(`start_time`, `location`, `description`, `image`, `user_id`, `category_id`, `followers`, `max_followers`, `title`, `state`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $this->getCurrentFollowerNumber = $dbConnection->prepare_statement("SELECT `followers`, `max_followers` From `activities` where `activity_id` = ?");
                                                                               

            $this->deleteActiv = $dbConnection->prepare_statement("DELETE FROM `activities` WHERE `activity_id` = ?");
            $this->updateFollower = $dbConnection->prepare_statement("UPDATE `activities` SET `followers` = `followers` + 1 WHERE `activity_id` = ?");
            $this->removeFollow = $dbConnection->prepare_statement("UPDATE `activities` SET `followers` = `followers` - 1 WHERE `activity_id` = ?");

            //$this->retrieveAll = $dbConnection->prepare_statement("SELECT * FROM `activities`");
            //$this->retrieveOne = $dbConnection->prepare_statement("SELECT * FROM `activities` WHERE `activity_id` = ?");
            $this->retrieveCate = $dbConnection->prepare_statement("SELECT * FROM `activities` WHERE `category_id` = ?");
            $this->retriveUnVerify = $dbConnection->prepare_statement("SELECT * FROM `activities` WHERE `state` = 0");       
                        $this->updateActivity=$dbConnection->prepare_statement("UPDATE `activities` SET `start_time` = ?,`location`=?,`title`=?,`max_followers`=?,`state`=?,`description`=? WHERE `activity_id` = ?");
            $this->getPartInfo=$dbConnection->prepare_statement("SELECT `activity_id`,`start_time`,`location`,`title`,`max_followers`,`state`,`description` FROM `activities` WHERE `activity_id` = ?");   
        }
        public function __destruct(){     
            $this->addActiv->close(); 
            $this->deleteActiv->close(); 
            $this->updateFollower->close();
            $this->removeFollow->close();
            $this->getCurrentFollowerNumber->close();

            //$this->retrieveAll->close();
            $this->retrieveCate->close();
            //$this->retrieveOne->close();
            $this->retriveUnVerify->close();

            $this->updateActivity->close();
            $this->getPartInfo->close();
        }
    }
    class activity_images{
        private $addImage;

        public function addImage($activity_id, $name, $image) {    //state, following number
            $this->addImage->bind_param("iss", $activity_id, $name, $image);
            $this->addImage->execute();   
        }
        public function retrieveImage($activity_id) {    //state, following number
            global $dbConnection;         
            return $dbConnection->send_sql("SELECT * FROM `activity_images` where `activity_id` = $activity_id ")->fetch_all(MYSQLI_ASSOC);
        }
        public function retrieveAllImage() {    //for test purpose
            global $dbConnection;         
            return $dbConnection->send_sql("SELECT * FROM `activity_images`")->fetch_all(MYSQLI_ASSOC);
        }
        

        public function deleteImageByActivity($activity_id){   
            global $dbConnection;
            $dbConnection->send_sql("DELETE FROM `activity_images` where `activity_id` = $activity_id");
        }
        public function deleteImageByName($activity_id, $name){
            global $dbConnection;
            $dbConnection->send_sql("DELETE FROM `activity_images` where `activity_id` = $activity_id and `name_image` = $name");
        }

        public function __construct ()
        {   
            global $dbConnection;          
            if($dbConnection == null) $dbConnection = new DatabaseConnection();            
            $this->addImage = $dbConnection->prepare_statement("INSERT INTO `activity_images`(`activity_id`, `name_image`, `image`) VALUES(?, ?, ?)");    
        }
        public function __destruct(){     
            $this->addImage->close();             
        } 
    }


    class category
    {   
        private $addCate;
        private $deleteCate;
        private $updateCate;
        private $retrieveAll;
        private $retrieveOne;

        public function addCategory($category_name, $description) {    //state, following number
            $this->addCate->bind_param("ss", $category_name, $description);
            $this->addCate->execute();   
        }
        public function deleteCategory($category_id){
            $this->deleteCate->bind_param("i", $category_id);
            $this->deleteCate->execute();
        }
        public function updateCategory($category_id, $description){
            $this->updateCate->bind_param("is", $category_id, $description);
            $this->updateCate->execute();
        }
        public function getAllCategory(){
            $res = array();
            $this->retrieveAll->execute();
            $this->retrieveAll->bind_result($category_id, $category_name, $description);
            while($this->retrieveAll->fetch()){
                $newTuple = array("category_id" => $category_id, "category_name" => $category_name, "description" => $description);
                array_push($res, $newTuple);               
            }
            return $res;            
        }
        public function getOneCategory($category_id){
            $res = array();
            $this->retrieveOne->execute();
            $this->retrieveOne->bind_result($category_name, $description);
            while($this->retrieveOne->fetch()){
                $newTuple = array("category_name" => $category_name, "description" => $description);
                array_push($res, $newTuple);               
            }
            return $res[0];            
        }
        public function __construct ()
        {   
            global $dbConnection;          
            if($dbConnection == null) $dbConnection = new DatabaseConnection();
            
            $this->addCate = $dbConnection->prepare_statement("INSERT INTO `category`(`category_name`, `description`) VALUES(?, ?)");
            $this->deleteCate = $dbConnection->prepare_statement("DELETE FROM `category` WHERE `category_id` = ?");
            $this->updateCategory = $dbConnection->prepare_statement("UPDATE `category` SET `description` = ? WHERE `category_id` = ?");
            $this->retrieveAll = $dbConnection->prepare_statement("SELECT * FROM `category`");
            $this->retrieveOne = $dbConnection->prepare_statement("SELECT * FROM `category` WHERE `category_id` = ?");       
        }
        public function __destruct(){     
            $this->addCate->close(); 
            $this->deleteCate->close(); 
            $this->updateCategory->close();
            $this->retrieveAll->close();
            $this->retrieveOne->close();
        }   
    }
    class following
    {     
        private $addFollowers;
        private $removeFollower;
        private $deleteFollowersU;
        private $deleteFollowersA;
        private $getGroup;        //according to activities name, activities title
        private $getEventList;
        private $isFollow;

        public function addFollower($activity_id, $user_id, $follow_time) {    
            $this->addFollowers->bind_param("iis", $activity_id, $user_id, $follow_time);
            $this->addFollowers->execute();   
        }
        public function removeFollowFromOneEvent($activity_id, $user_id){
            $this->removeFollower->bind_param("ii", $activity_id, $user_id);
            $this->removeFollower->execute();
        }

        public function deleteFollowerActivity($activity_id){   //activity delete    
            $this->deleteFollowersA->bind_param("i", $activity_id);
            $this->deleteFollowersA->execute(); 
        }
        public function deleteFollowerUser($user_id){           //totally delete this user
            $this->deleteFollowersU->bind_param("i", $user_id);
            $this->deleteFollowersU->execute();
        }
        public function isfollowing($activity_id, $user_id){
            $res = array();
            $this->isFollow->bind_param("ii", $activity_id, $user_id);
            $this->isFollow->execute();
            $this->isFollow->bind_result($count);

            while($this->isFollow->fetch()){
                $newTuple = array("count" => $count);
                array_push($res, $newTuple);               
            }
            return $res[0]; 
        }
        public function getGroupPeople($activity_id){
            $res = array();
            $this->getGroup->bind_param("i", $activity_id);
            $this->getGroup->execute();

            $this->getGroup->bind_result($email, $fname, $lname);

            while($this->getGroup->fetch()){
                $newTuple = array("email" => $email, "fname" => $fname, "lname" => $lname);
                array_push($res, $newTuple);               
            }
            return $res; 
        }

        public function getPersonalEventList($user_id){
            $res = array();
            $this->getEventList->bind_param("i", $user_id);
            $this->getEventList->execute();
            $this->getEventList->bind_result($activity_id, $title, $start_time);
            while($this->getEventList->fetch()){
                $newTuple = array("activity_id" => $activity_id, "title" => $title, "start_time" => $start_time);
                array_push($res, $newTuple);               
            }
            return $res; 
        }

        public function __construct ()
        {   
            global $dbConnection;          
            if($dbConnection == null) $dbConnection = new DatabaseConnection();

            $this->addFollowers = $dbConnection->prepare_statement("INSERT INTO `following`(`activity_id`, `user_id`, `follow_time`) VALUES(?, ?, ?)");
            $this->removeFollower = $dbConnection->prepare_statement("DELETE FROM `following` WHERE `activity_id` = ? and `user_id` = ?");

            $this->deleteFollowersU = $dbConnection->prepare_statement("DELETE FROM `following` WHERE `user_id` = ?");
            $this->deleteFollowersA = $dbConnection->prepare_statement("DELETE FROM `following` WHERE `activity_id` = ? ");                   
            $this->isFollow = $dbConnection->prepare_statement("SELECT count(*) as `count` FROM `following` WHERE `activity_id` = ? and `user_id` = ?");
            //check!!!! this sql modify later!!!!!!!
            $this->getGroup = $dbConnection->prepare_statement("SELECT `email`,`fname`,`lname` from `user` NATURAL JOIN `user_info` WHERE user.user_id IN (SELECT `user_id` from `following` WHERE `activity_id` = ?)");
            $this->getEventList = $dbConnection->prepare_statement("SELECT `activity_id`, `title`, `start_time` FROM `activities` NATURAL JOIN (SELECT `activity_id` from `following` where `user_id` = ?) as T ");      
        }
        public function __destruct(){     
            $this->addFollowers->close(); 
            $this->deleteFollowersU->close(); 
            $this->deleteFollowersA->close();
            $this->isFollow->close();
            $this->removeFollower->close();
            $this->getGroup->close();
            $this->getEventList->close();
        } 
    }

class UserModel{
    
    private $db;
    private $createuser;
    private $createavtivationcode;
    private $getuser;
    private $vertifycode;
    private $updateuserinfo;
    private $changepassword;

    public function __construct(){
        $this->db = new DatabaseConnection();
        $this->createuser = $this->db->prepare_statement("INSERT INTO `USER` (email, password, salt) VALUES (?,?,?)");
        $this->createavtivationcode = $this->db->prepare_statement("INSERT INTO `User_activation` (user_id, activation_key,expire) VALUES (?,?,?)");
        $this->createuserinfo = $this->db->prepare_statement("INSERT INTO `User_Info` (user_id) VALUES (?)");
        $this->getuser = $this->db->prepare_statement("SELECT * FROM `USER` WHERE `email` = ?");
        
        $this->vertifycode = $this->db->prepare_statement(
            "UPDATE `USER` SET `is_activated` = '1' WHERE `USER_ID` = (SELECT `USER_ID` FROM `USER_ACTIVATION` WHERE `activation_key` = ? LIMIT 1)"
        );
        $this->updateuserinfo = $this->db->prepare_statement(
            "UPDATE `User_Info` SET `lname`=?, `fname`=?, `address1`=?, `address2`=?, `zip`=?, `tel`=?, `preference`=? WHERE `user_id`=?"
        );
        $this->changepassword = $this->db->prepare_statement(
            "UPDATE `USER` SET `password` = ?, `SALT`=? WHERE `user_id` = ?"
        );
    }

    public function __destruct(){
        $this->createuser->close();
    }

    public function createuser($email,$password,$salt,$code){
        $this->createuser->bind_param("sss",$email,$password,$salt);
        $success = $this->createuser->execute();
        if($success == true){
            // Last insert id
            $last_pk = $this->db->last_insert_id();
            // Insert activation key
            $dateTime = date("Y-m-d H:i:s",strtotime("+24 hours"));
            $this->createavtivationcode->bind_param("sss",$last_pk,$code, $dateTime);
            $this->createavtivationcode->execute();
            // Insert userinfo
            $this->createuserinfo->bind_param("s",$last_pk);
            $this->createuserinfo->execute();
            return true;
        }else
            return false;

    }

    public function getuser($email){
        $user_array = array();
        $this->getuser->bind_param("s", $email);
        if($this->getuser->execute()){
            $this->getuser->bind_result($id, $email, $pass, $admin,$act, $postnum,$salt);
            $this->getuser->fetch();
            $user_array[] = array(
                'id' => $id,
                'email' => $email,
                'password' => $pass,
                'admin' => $admin,
                'activated' => $act,
                'postnum' => $postnum,
                'salt' => $salt,
            );
            if($id != NULL){
                return $user_array;
            }else{
                return NULL;
            }
        }
    }

    public function vertifycode($email,$code){
        
        $this->vertifycode->bind_param("s",$code);
        $this->vertifycode->execute();
        return $this->vertifycode->affected_rows;

    }

    public function updateuserinfo($lname,$fname,$address1,$address2,$tel,$zip,$preference,$user_id){
        $this->updateuserinfo->bind_param("ssssssss",$lname,$fname,$address1,$address2,$tel,$zip,$preference,$user_id);
        $this->updateuserinfo->execute();
        
    }

    public function getuserinfo(){
        $query = "SELECT * FROM `USER_INFO`";
        return $this->db->send_sql($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getuserinfobyuserid($id){
        $query = "SELECT * FROM `USER_INFO` WHERE `user_id` = ".$id;
        return $this->db->send_sql($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function changepassword($password,$salt,$user_id){
        $this->changepassword->bind_param("sss",$password,$salt,$user_id);
        $this->changepassword->execute();

    }


    // Admin
    public function getalluser(){
        $query = "SELECT * FROM `USER`";
        return $this->db->send_sql($query)->fetch_all(MYSQLI_ASSOC);
    }
    
     public function getuserIsadminById($id){
        $query = "SELECT `is_admin` FROM `USER` WHERE `user_id` = '$id'";
        return $this->db->send_sql($query)->fetch_all(MYSQLI_ASSOC);
    }



}
class User{
    private $dbConnection;
    private $deleteUserStatement;
    private $deleteUserInfoStatement;
    private $deleteUserActivStatement;
    private $deleteFollowerStatement;
    private $updateUserStatement;
    private $getUsersByStatement;
    private $getUserNameByStatement;

    public function getUsersByPreference($preference){
        $ret = array();
        $fname=null;
        $lname=null;
        //echo $preference;
        //$this->getUsersByStatement->bind_param("i", $preference);
        $this->getUsersByStatement->bind_param("s", $preference);
        $this->getUsersByStatement->execute();
        $this->getUsersByStatement->bind_result($fname,$lname);
        
        while($this->getUsersByStatement->fetch()) {
            $newEntry = array ("fname" => $fname, "lname" => $lname);
            //var_dump($newEntry);
            array_push($ret, $newEntry);
        }
        return $ret;
    }
    public function getUserNameById($Id){
        $ret = array ();
        $fname=null;
        $lname=null;
        $this->getUserNameByStatement->bind_param("s", $Id);
        $this->getUserNameByStatement->execute();
        $this->getUserNameByStatement->bind_result($fname,$lname);
        
        while($this->getUserNameByStatement->fetch()) {
            $newEntry = array ("fname" => $fname, "lname" => $lname);
            array_push($ret, $newEntry);
        }
        return $ret;
    }
    
    
    public function getAllUsers(){
        return $this->dbConnection->send_sql("SELECT * FROM `user`")->fetch_all(MYSQLI_ASSOC);
    }
    public function deleteUser($user_id){
        $this->deleteUserStatement->bind_param("i", $user_id);
        $this->deleteUserStatement->execute();
    }
    public function deleteUserInfo($user_id){
        $this->deleteUserInfoStatement->bind_param("i", $user_id);
        $this->deleteUserInfoStatement->execute();
    }
    public function deleteUserActiv($user_id){
        $this->deleteUserActivStatement->bind_param("i", $user_id);
        $this->deleteUserActivStatement->execute();
    }
    public function deleteFollower($user_id){
        $this->deleteFollowerStatement->bind_param("i", $user_id);
        $this->deleteFollowerStatement->execute();
    }
    
    public function updateUser($user_id,$is_activated){
        $this->updateUserStatement->bind_param("ii",$is_activated,$user_id);
        $this->updateUserStatement->execute();
    }
    
    public function Paging(&$paging){
        $row=$this->dbConnection->send_sql("SELECT COUNT(`user_id`) FROM `user`")->fetch_all(MYSQLI_NUM);
        $paging->rowCount=$row[0][0];
        $paging->pageCount=ceil($paging->rowCount/$paging->pageSize);
        $sql="SELECT * FROM `user` LIMIT ".($paging->pageNow-1)*$paging->pageSize.",$paging->pageSize";
        return $this->dbConnection->send_sql($sql)->fetch_all(MYSQLI_ASSOC);
    }
    
    public function __construct ()
    {
        $this->dbConnection = new DatabaseConnection();
        $this->deleteUserStatement = $this->dbConnection->prepare_statement("DELETE FROM `user` WHERE `user_id` = ?");
        $this->deleteUserInfoStatement = $this->dbConnection->prepare_statement("DELETE FROM `user_info` WHERE `user_id` = ?");
        $this->deleteUserActivStatement = $this->dbConnection->prepare_statement("DELETE FROM `user_activation` WHERE `user_id` = ?");
        $this->deleteFollowerStatement = $this->dbConnection->prepare_statement("DELETE FROM `following` WHERE `user_id` = ?");
        $this->updateUserStatement=$this->dbConnection->prepare_statement("UPDATE `user` SET `is_activated`=? WHERE `user_id` = ?");
        $this->getUsersByStatement=$this->dbConnection->prepare_statement("SELECT `fname`,`lname` FROM `user_info` WHERE `preference`=?");
        $this->getUserNameByStatement=$this->dbConnection->prepare_statement("SELECT `fname`,`lname` FROM `user_info`  WHERE `user_id`=?");
    }
    
    // It's good practice to close your resources on destruct.
    function __destruct(){
        $this->deleteUserStatement->close();
        $this->deleteUserInfoStatement->close();
        $this->deleteUserActivStatement->close();
        $this->deleteFollowerStatement->close();
        $this->updateUserStatement->close();
        $this->getUsersByStatement->close();
        $this->getUserNameByStatement->close();
    }
}

class MessageService
    {
        private $dbConnection;
        private $addMessageStatement;
        private $getMessagesStatement;
        private $updateMessageStatement;
        private $deleteMessageStatement;

        public function getMessage($Sender,$Getter)
        {
            $ret = array ();
            $id = null;
            $sender = null;
            $getter = null;
            $content = null;
            $sendTime=null;
            $isGet=null;
            $this->getMessagesStatement->bind_param("ss",$Sender,$Getter);
            $this->getMessagesStatement->execute();
            $this->getMessagesStatement->bind_result($id, $sender, $getter, $content,$sendTime,$isGet);
            while ($this->getMessagesStatement->fetch()) {
                $newEntry = array ("id" => $id, "sender" => $sender, "getter" => $getter, "content" => $content,"sendTime"=>$sendTime,"isGet"=>$isGet);
                array_push($ret, $newEntry);
            }
            $this->updateMessage($Sender, $Getter);
            return $ret;
        }

        public function updateMessage($sender, $getter)
        {
            $this->updateMessageStatement->bind_param("ss",$sender,$getter);
            $this->updateMessageStatement->execute();
        }

        public function deleteMessage ($id)
        {
            $this->deleteMessageStatement->bind_param("i", $id);
            $this->deleteMessageStatement->execute();
        }

        public function getAll_information ()
        {
            return $this->dbConnection->send_sql("SELECT * FROM `track_expense`")->fetch_all(MYSQLI_ASSOC);
        }

        public function storeMessage ($sender,$getter,$content)
        {
            $this->addMessageStatement->bind_param("sss", $sender,$getter,$content);
            $this->addMessageStatement->execute();
        }

        // This is your constructor
        public function __construct ()
        {
            $this->dbConnection = new DatabaseConnection();
            $this->addMessageStatement = $this->dbConnection->prepare_statement("INSERT INTO `messages` (`sender`,`getter`,`content`,`sendTime`,`isGet`) VALUES (?,?,?,now(),0)");
            $this->getMessagesStatement = $this->dbConnection->prepare_statement("SELECT * FROM `messages` WHERE `sender`=? and `getter`=? and `isGet`=0");
            $this->updateMessageStatement = $this->dbConnection->prepare_statement("UPDATE `messages` SET `isGet` =1 WHERE `sender`=? and `getter`=?");
            $this->deleteMessageStatement = $this->dbConnection->prepare_statement("DELETE FROM `messages` WHERE `id` = ?");
        }

        // It's good practice to close your resources on destruct.
        function __destruct(){
            $this->addMessageStatement->close();
            $this->getMessagesStatement->close();
            $this->updateMessageStatement->close();
            $this->deleteMessageStatement->close();
        }
    }
?>