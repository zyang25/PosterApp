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
  $Paging=new Paging();
  session_start();
  $ActivData=new activity();
  $follower_info=new following();
  if(isset($_REQUEST['dele_sign'])){
      $activity_id=$_REQUEST['activity_id'];
      $ActivData->deleteEvent($activity_id);
      $follower_info->deleteFollowerActivity($activity_id);
  }
  
  if(!empty($_GET['pageNow'])){
      $Paging->pageNow=$_GET['pageNow'];
  }
  $res=$ActivData->Paging($Paging);
  echo "</br></br></br></br>";
    echo "<h1>ActivityList</h1>";
  echo "<table class='table' border='1px' bordercolor='green' cellspacing='0px' width='700px' id='all_data'>";
  echo "<tr><th>activity_id</th><th>start_time</th><th>location</th><th>description</th><th>image</th><th>user_id</th><th>category_id</th><th>followers</th><th>max_followers</th><th>title</th><th>state</th></tr>";
  foreach($res as $key=>$val){
      echo "<tr><td>".$val['activity_id']."</td><td>".$val['start_time']."</td><td>".$val['location']."</td><td>".$val['description']."</td><td>".$val['image']."</td><td>".$val['user_id']."</td><td>".$val['category_id']."</td><td>".$val['followers']."</td><td>".$val['max_followers']."</td><td>".strip_tags($val['title'])."</td><td>".$val['state']."</td></tr>";
  }
  echo "</table>";
  echo "<center>";
  
  if($Paging->pageNow>1){
      $prePage=$Paging->pageNow-1;
      echo "<a href='ActivList.php?pageNow=$prePage'>prev_page</a>&nbsp;";
  }
  if($Paging->pageNow<$Paging->pageSize){
      $nextPage=$Paging->pageNow+1;
      echo "<a href='ActivList.php?pageNow=$nextPage'>next_page</a>&nbsp;";
  }
  echo "current_page$Paging->pageNow/total_page$Paging->pageCount";
  echo "</br></br>";
  echo "</center>";
?>

<script type="text/javascript">

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

function getXmlHttpObject(){
	   var xmlHttpRequest;
	  if(window.ActiveXobjext){
		  xmlHttpRequest=new ActiveXobjext("Micorsoft.XMLHTTP");
	  }
	   else{
		  xmlHttpRequest=new XMLHttpRequest();
	  }
	      return xmlHttpRequest;
}
function $(id){
	   return document.getElementById(id);
}

function Update(){
		var myXmlHttpRequest=getXmlHttpObject();
		if (myXmlHttpRequest){
			var url="ActivContoller.php";
			var data;
			data="activity_id="+$('activity_id').value+"&start_time="+$('start_time').value+"&location="+$('location').value+"&title="+$('title').value+"&max_followers="+$('max_followers').value+"&state="+$('state').value+"&description="+$('description').value;
			myXmlHttpRequest.open("post",url,true);
			myXmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			myXmlHttpRequest.onreadystatechange=function(){
				if(myXmlHttpRequest.readyState==4){
					if(myXmlHttpRequest.status==200){
						var mes=myXmlHttpRequest.responseText;
						var mes_obj=eval("("+mes+")");
						var rows=$('all_data').rows; 
						for(var i=1;i<rows.length;i++){
								if(rows[i].cells[0].innerHTML==mes_obj[0].activity_id){
										rows[i].cells[1].innerHTML=mes_obj[0].start_time;
										rows[i].cells[2].innerHTML=mes_obj[0].location;
										rows[i].cells[3].innerHTML=mes_obj[0].description;
										rows[i].cells[8].innerHTML=mes_obj[0].max_followers;
										rows[i].cells[9].innerHTML=mes_obj[0].title;
										rows[i].cells[10].innerHTML=mes_obj[0].state;
										break;
									}
							} 
						}
					}
				}
			}
			myXmlHttpRequest.send(data);
		}

function Show(){
	var myXmlHttpRequest=getXmlHttpObject();
	if (myXmlHttpRequest){
		var url="ActivContoller.php";
		var data;
		data="activity_id="+$('activity_id').value;
		myXmlHttpRequest.open("post",url,true);
		myXmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		myXmlHttpRequest.onreadystatechange=function(){
			if(myXmlHttpRequest.readyState==4){
				if(myXmlHttpRequest.status==200){
					var mes=myXmlHttpRequest.responseText;
					var mes_obj=eval("("+mes+")");
					//window.alert(mes_obj[0].location);
					$('start_time').value=mes_obj[0].start_time;
					$('location').value=mes_obj[0].location;
					$('title').value=mes_obj[0].title;
					$('max_followers').value=mes_obj[0].max_followers;
					$('state').value=mes_obj[0].state;
					$('description').value=mes_obj[0].description;
				}
			}
		}
		myXmlHttpRequest.send(data);
	}
}

</script>
</head>
    <body>
            <?php
            include("../main/nav.php");
            ?>
            <center>
            <form action="ActivList.php">
            GOTO:<input type="text" name="pageNow">
            <input type="submit" name="GO">
            </form>
            <br><br>

            <button type="button" class="btn btn-default" id="update" onclick="display(this)">update</button>
            <button type="button" class="btn btn-default" id="delete" onclick="display(this)">delete</button>

            <br><br>
            <table id="tab" class="table" style="display:none">
                <tr><td>activity_id:</td><td><input type="text" name="activity_id" id="activity_id" onChange="Show()"></input></td></tr>
                <tr><td>start_time:</td><td><input type="text" name="start_time" id="start_time"/></td></tr>
                <tr><td>location:</td><td><input type="text" name="location:" id="location"/></td></tr>
                <tr><td>title:</td><td><input type="text" name="title" id="title"/></td></tr>
                <tr><td>max_followers:</td><td><input type="text" name="max_followers" id="max_followers"/></td></tr>
                <tr><td>state:</td><td><input type="text" name="state" id="state"/></td></tr>
                <tr><td>description:</td><td><textarea name="description" id="description" rows="10" cols="80"></textarea></td></tr>
                <tr><td></td><td style="text-align:right"><input type="submit" value="update" id="but" onclick="Update()"></input></td></tr>
            </table>

            <form id="form" style="display:none" method="post" action="ActivList.php?dele_sign=1">
                activity_id:<input type="text" name="activity_id" id="activity_id"></input>
                <input type="submit" value="delete" id="b"></input>
            </form>

            </center>



</body>
</html>