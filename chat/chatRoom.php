<!DOCTYPE html>
<html>
<head>
<?php
   require_once '../main/data.php';
   session_start();
   $id=$_SESSION['user_id'];
   $userservice = new User();
   $users = $userservice->getUserNameById($id);
   
   foreach ($users as $key => $value) {
   		$loginuser = $value['fname'].' '.$value['lname'];
   }
   $username=$_GET['username'];
   
?>
<script type="text/javascript" src="my.js"></script>
<script type="text/javascript">
function getMessage(){
	var myXmlHttpRequest=getXmlHttpObject();
	if(myXmlHttpRequest){
	var url="GetMessageController.php";
	var data="getter=<?php echo $loginuser;?>&sender=<?php echo $username;?>";
	myXmlHttpRequest.open("post",url,true);
	myXmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	myXmlHttpRequest.onreadystatechange=function(){
			if(myXmlHttpRequest.readyState==4){
				if(myXmlHttpRequest.status==200){
					var mesRes=myXmlHttpRequest.responseXML;
					var contents=mesRes.getElementsByTagName("content");
					var sendTimes=mesRes.getElementsByTagName("sendTime");
					if(contents.length!=0){
						for(var i=0;i<contents.length;i++){
							$('mycons').value+="<?php echo $username;?> says to <?php echo $loginuser;?>:"+contents[i].childNodes[0].nodeValue+"\r\n";
						}
					}
				}
			}
		}
	 myXmlHttpRequest.send(data);
	}
}
function sendMessage(){
	var myXmlHttpRequest=getXmlHttpObject();
	if (myXmlHttpRequest){
		var url="SendMessageController.php";
		var data="content="+$('content').value+"&getter=<?php echo $username;?>&sender=<?php echo $loginuser;?>";
		myXmlHttpRequest.open("post",url,true);
		myXmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		myXmlHttpRequest.onreadystatechange=function(){
			if(myXmlHttpRequest.readyState==4){
				if(myXmlHttpRequest.status==200){
				}
			}
		}
		myXmlHttpRequest.send(data);
		$('mycons').value+="you say to <?php echo $username;?>:"+$('content').value+" "+new Date().toLocaleString()+"\r\n";
	}
}
       window.setInterval("getMessage()",5000);
</script>
</head>

<body>
   <center>
   <h1>ChattingRoom(<font color="red"><?php echo $loginuser;?></font> are chatting with <font color="red"><?php echo $username;?></font> now)</h1>
   <textarea cols="50" rows="20" id="mycons"></textArea>
   <input type="text" id="content"/>
   <input type="button" value="send" onclick="sendMessage()"/>
   </center>
</body>
</html>