<?php
   require_once '../main/data.php';
   $sender=$_POST['sender'];
   $getter=$_POST['getter'];
   $content=$_POST['content'];
   //file_put_contents("c:\hi\mylog.log",$sender."--".$getter."--".$content."\r\n",FILE_APPEND);
   $MessageService=new MessageService();
   $MessageService->storeMessage($sender,$getter,$content);

?>