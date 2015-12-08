<!DOCTYPE html>
<html>
<head>
        <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/bootstrap/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="../assets/css/half-slider.css" rel="stylesheet">

         <!-- jQuery -->
        <script src="../assets/js/jquery-1.11.1.js"></script>
        <script src="../assets/js/moment-with-locales.js"></script>
        <script src="../assets/js/bootstrap-datetimepicker.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<?php
  require_once '../main/data.php';
  require_once 'Paging.class.php';
  session_start();
  $Paging=new Paging();
  $UserData=new User();
  if(isset($_REQUEST['dele_sign'])){
      $user_id=$_REQUEST['user_id'];
      $UserData->deleteUser($user_id);
      $UserData->deleteUserInfo($user_id);
      $UserData->deleteUserActiv($user_id);
      $UserData->deleteFollower($user_id);
  }
  if(isset($_REQUEST['update_sign'])){
      $user_id=$_REQUEST['user_id'];
      $is_activated=$_REQUEST['is_activated'];
      $UserData->updateUser($user_id, $is_activated);
  }
  
  if(!empty($_GET['pageNow'])){
      $Paging->pageNow=$_GET['pageNow'];
  }
  $res=$UserData->Paging($Paging);
  echo "</br>";
  echo "</br></br>";
  echo "<h1>USER LIST</h1>";
  echo "<table class='table' border='1px' bordercolor='green' cellspacing='0px' width='700px' id='all_data'>";
  echo "<tr><th>user_id</th><th>email</th><th>password</th><th>is_admin</th><th>is_activated</th></tr>";
  foreach($res as $key=>$val){
      echo "<tr><td>".$val['user_id']."</td><td>".$val['email']."</td><td>".$val['password']."</td><td>".$val['is_admin']."</td><td>".$val['is_activated']."</td></tr>";
  }
  echo "</table>";
  echo "<center>";
  if($Paging->pageNow>1){
      $prePage=$Paging->pageNow-1;
      echo "<a href='UserList.php?pageNow=$prePage'>prev_page</a>&nbsp;";
  }
  if($Paging->pageNow<$Paging->pageSize){
      $nextPage=$Paging->pageNow+1;
      echo "<a href='UserList.php?pageNow=$nextPage'>next_page</a>&nbsp;";
  }
  echo "current_page$Paging->pageNow/total_page$Paging->pageCount";
  echo "</br></br>";
    echo "</center>";
?>

<script type="text/javascript">

function $(id){
	   return document.getElementById(id);
}

function display(obj){
	   if(obj.innerHTML=="update"){
             if($('tab').style.display!="none"){
	                 $('tab').style.display="none";
	                 $('delete').disabled=false;
              }
             else
              {
                   $('delete').disabled="true";
	               $('tab').style.display="block";
	               $('but').value="update";
              }
		   }
	   else{
		     if($('form').style.display!="none"){
			     $('form').style.display="none";
			     $('update').disabled=false;
	               }
	         else{
	        	   $('update').disabled="true";
	        	   $('form').style.display="block";
		           $('b').value="delete";
	             }
		   }
	   }

</script>
</head>
<body>
    <?php
        include("../main/nav.php");
    ?>
    <center>
    <div class="row">
        <form action="UserList.php">
        GOTO:<input type="text" name="pageNow">
        <input type="submit" name="GO">
        </form>
        <br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;<button type="button"  class="btn btn-default" id="update" onclick="display(this)">update</button>
      &nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" class="btn btn-default" id="delete" onclick="display(this)">delete</button>

        <br><br>
        <form id="tab" style="display:none" action="UserList.php?update_sign=1" method="post">
        <table class="table">
            <tr><td>user_id:</td><td><input type="text" name="user_id" id="user_id"></input></td></tr>
            <tr><td>is_activated:</td><td><input type="text" name="is_activated" id="is_activated"/></td></tr>
            <tr><td></td><td style="text-align:right"><input type="submit" value="update" id="but"></input></td></tr>
        </table>
        </form>

        <form id="form" style="display:none" method="post" action="UserList.php?dele_sign=1">
            user_id:<input type="text" name="user_id" id="user_id"></input>
            <input type="submit" value="delete" id="b"></input>
        </form>
    </div>
    </enter>
</body>
</html>