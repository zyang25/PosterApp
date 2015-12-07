<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
function color_change(val,obj){
     if (val=='over'){
	  obj.style.color="red";
	  obj.style.cursor='pointer';
	 }
	 else if (val=='out'){
	  obj.style.color="black";
	 }
}
function openChatRoom(obj){
   window.open("chatRoom.php?username="+obj.innerHTML,"_blank");
}
</script>
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
      echo "<ul>";
      foreach ($Users as $key=>$val){
          echo "<li onmouseover=\"color_change('over',this)\" onclick='openChatRoom(this)' onmouseout=\"color_change('out',this)\">".$val['fname']." ".$val['lname']."</li>"; 
      }
      echo "</ul>";
?>
</head>
<body>
</body>
</html>
