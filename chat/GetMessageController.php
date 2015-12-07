<?php
   require_once '../main/data.php';
   header('content-type:text/xml');
   header("Cache-Control:no-cache");
   $sender=$_POST['sender'];
   $getter=$_POST['getter'];
   $MessageService=new MessageService();
   $arr=$MessageService->getMessage($sender,$getter);
   $messageInfo="<meses>";
   for($i=0;$i<count($arr);$i++){
	   $row=$arr[$i];
	   //file_put_contents("c:\hi\mylog.log",$row['content']."\r\n",FILE_APPEND);
	   $messageInfo.="<mesid>{$row['id']}</mesid><sender>{$row['sender']}</sender><getter>{$row['getter']}</getter><content>{$row['content']}</content><sendTime>{$row['sendTime']}</sendTime>";
   }
   $messageInfo.="</meses>";
   //file_put_contents("c:\hi\mylog.log",$messageInfo."\r\n",FILE_APPEND);
   echo $messageInfo;

?>