<?php
    require_once 'connection.php'; 

    $dbConnection;
    class activity
    {
        private $addActiv;
        private $deleteActiv;
        private $updateFollower;
        private $removeFollow;
        private $retrieveAll;   //retrieve all 
        private $retrieveCate;  //get back all info depend on category
        private $retrieveOne;   //one event
        private $retriveUnVerify;

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

        public function removeFollow($activity_id){
            $this->removeFollow->bind_param("i", $activity_id);
            $this->removeFollow->execute();
        }

        public function getAllEvent(){
            $res = array();
            $this->retrieveAll->execute();
            $this->retrieveAll->bind_result($activity_id, $start_time, $location, $description, $image, $user_id, $category_id, $followers, $max_followers, $title, $state);
            while($this->retrieveAll->fetch()){
                $newTuple = array("activity_id" => $activity_id, "start_time" => $start_time, "location" => $location, "description" => $description, "image" => $image, "user_id" => $user_id, "category_id" =>  $category_id, "followers" => $followers, "max_followers" => $max_followers, "title" => $title, "state" => $state);
                array_push($res, $newTuple);               
            }
            return $res;
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
        public function getOneEvent($activity_id){
            $res = array();            
            $this->retrieveOne->bind_param("i", $activity_id);
            $this->retrieveOne->execute();
            $this->retrieveOne->bind_result($start_time, $location, $description, $image, $user_id, $category_id, $followers, $max_followers, $title, $state);
            while($this->retrieveOne->fetch()){
                $newTuple = array("start_time" => $start_time, "location" => $location, "description" => $description, "image" => $image, "user_id" => $user_id, "category_id" =>  $category_id, "followers" => $followers, "max_followers" => $max_followers, "title" => $title, "state" => $state);
                array_push($res, $newTuple);
            }
            return $res[0]; 
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
        public function __construct ()
        {   
            global $dbConnection;
            if($dbConnection == null) $dbConnection = new DatabaseConnection();
        

            $this->addActiv = $dbConnection->prepare_statement("INSERT INTO `activities`(`start_time`, `location`, `description`, `image`, `user_id`, `category_id`, `followers`, `max_followers`, `title`, `state`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
            

            $this->deleteActiv = $dbConnection->prepare_statement("DELETE FROM `activities` WHERE `activity_id` = ?");
            $this->updateFollower = $dbConnection->prepare_statement("UPDATE `activities` SET `followers` = `followers` + 1 WHERE `activity_id` = ?");
            $this->removeFollow = $dbConnection->prepare_statement("UPDATE `activities` SET `followers` = `followers` - 1 WHERE `activity_id` = ?");

            $this->retrieveAll = $dbConnection->prepare_statement("SELECT * FROM `activities`");
            $this->retrieveOne = $dbConnection->prepare_statement("SELECT * FROM `activities` WHERE `activity_id` = ?");
            $this->retrieveCate = $dbConnection->prepare_statement("SELECT * FROM `activities` WHERE `category_id` = ?");
            $this->retriveUnVerify = $dbConnection->prepare_statement("SELECT * FROM `activities` WHERE `state` = 0");          
        }
        public function __destruct(){     
            $this->addActiv->close(); 
            $this->deleteActiv->close(); 
            $this->updateFollower->close();

            $this->retrieveAll->close();
            $this->retrieveCate->close();
            $this->retrieveOne->close();
            $this->retriveUnVerify->close();
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
        private $deleteFollowersU;
        private $deleteFollowersA;
        private $getGroup;        //according to activities name, activities title
        private $getEventList;

        public function addFollower($activity_id, $user_id, $follow_time) {    
            $this->addFollowers->bind_param("iis", $activity_id, $user_id, $follow_time);
            $this->addFollowers->execute();   
        }
        public function deleteFollowerActivity($activity_id){   //activity delete    
            $this->deleteFollowersA->bind_param("i", $activity_id);
            $this->deleteFollowersA->execute(); 
        }
        public function deleteFollowerUser($user_id){ 
            $this->deleteFollowersU->bind_param("i", $user_id);
            $this->deleteFollowersU->execute();
        }

        public function getGroupPeople($activity_id){
            $this->getGroup->bind_param("i", $activity_id);
            $this->getGroup->execute();
            $this->getGroup->bind_result($title, $firstName, $lastName);
            while($this->getGroup->fetch()){
                $newTuple = array("title" => $title, "firstName" => $firstName, "lastName" => $lastName);
                array_push($res, $newTuple);               
            }
            return $res; 
        }
        public function getPersonalEventList($user_id){
            $this->getEventList->bind_param("i", $user_id);
            $this->getEventList->execute();
            $this->getEventList->bind_result($activity_id, $title);
            while($this->getEventList->fetch()){
                $newTuple = array("activity_id" => $activity_id, "title" => $title);
                array_push($res, $newTuple);               
            }
            return $res; 
        }

        public function __construct ()
        {   
            global $dbConnection;          
            if($dbConnection == null) $dbConnection = new DatabaseConnection();

            $this->addFollowers = $dbConnection->prepare_statement("INSERT INTO `following`(`activity_id`, `user_id`, `follow_time`) VALUES(?, ?, ?)");
            $this->deleteFollowersU = $dbConnection->prepare_statement("DELETE FROM `following` WHERE `user_id` = ?");
            $this->deleteFollowersA = $dbConnection->prepare_statement("DELETE FROM `following` WHERE `activity_id` = ? ");                   
            //check!!!! this sql
            $this->getGroup = $dbConnection->prepare_statement("with `event_title`(`eve_title`, `activity_id`) as SELECT `title`, `activity_id` from `activities` where `activity_id` = ? with `get_userId`(`user_id`) as select `user_id` from `following` inner join `event_title` on event_title.user_id = following.user_id  SELECT `title`, `firstName`, `lastName` FROM `get_userId` natural join `User_Info` ");
            $this->getEventList = $dbConnection->prepare_statement("with `event_id`(`activity_id`) as SELECT `activity_id` from `following` where `user_id` = ?  SELECT `activity_id`, `title` FROM `activities` natrual join `event_id`");      
        }
        public function __destruct(){     
            $this->addFollowers->close(); 
            $this->deleteFollowersU->close(); 
            $this->deleteFollowersA->close();
            $this->getGroup->close();
            $this->getEventList->close();
        } 
    }
?>