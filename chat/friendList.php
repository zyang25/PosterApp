<!DOCTYPE html>
<html>
<head>
        <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
  .list-content{
 min-height:300px;
}
.list-content .list-group .title{
  background:#5bc0de;
  border:2px solid #DDDDDD;
  font-weight:bold;
  color:#FFFFFF;
}
.list-group-item img {
    height:80px; 
    width:80px;
}

.jumbotron .btn {
    padding: 5px 5px !important;
    font-size: 12px !important;
}
.prj-name {
    color:#5bc0de;    
}
.break{
    width:100%;
    margin:20px;
}
.name {
    color:#5bc0de;    
}

</style>

</head>
<body>
<?php
      require_once '../main/data.php';
      $UserService=new User();
      session_start();
      $p = $_SESSION['preference'];
      $Users = $UserService -> getUsersByPreference($p);
      //$preference='eat';
      //$preference=174;
      //$Email='jli75@stevens.edu';
      //$Users=$UserService->getUserNameByEmail($Email);
    
      echo "<h1>FriendList</h1>";
      echo "<div class='container bootstrap snippet'>";
      echo " <div class='jumbotron list-content'>";
      echo "<ul>";

      foreach ($Users as $key=>$val){
          //echo "<li onmouseover=\"color_change('over',this)\" onclick='openChatRoom(this)' onmouseout=\"color_change('out',this)\">".$val['fname']." ".$val['lname']."</li>"; 
          
          echo "<li onclick=\"openChatRoom('".$val['fname']." ".$val['lname']."');\" class='list-group-item text-left'>";
          echo "<img class='img-thumbnail' src='http://bootdey.com/img/Content/User_for_snippets.png'>";
          echo "<label class='name'>";
          echo "<div>".$val['fname']." ".$val['lname']."</div>"."<br>";
          echo "</label>";
          echo "<div class='break'></div>";
          echo "</li>";
      }
      echo "</ul>";
      echo "</div>";
      echo "</div>";
?>
</body>
<script type="text/javascript">
function openChatRoom(a){
   window.open("chatRoom.php?username="+a,"_blank");
}
</script>

</html>
