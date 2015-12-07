<?php 

session_start();
require_once('data.php');

if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <link href="../assets/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/half-slider.css" rel="stylesheet">

</head>

<body>

        <?php
        include("nav.php");
        ?>


<div>
	
	</div>
  </br>
  </br>
    </br>
  </br>



    <table class="table">

        <thead>

            <tr>

                <th>Title</th>

                <th>Start Time</th>

                <th>Location</th>

                <th>max followers</th>

                <th>op</th>

            </tr>

        </thead>

        <tbody>
        <?php
        $activity = new activity();
        $following = new following();
        $activity_array = $activity->getActivityByUserId($_SESSION['user_id']);

        for ($i= 0;$i< count($activity_array); $i++){ 
            echo "<tr>";
            echo "<td id='title".$activity_array[$i]['activity_id']."'>" . $activity_array[$i]['title']. "</td>"; 
            echo "<td>" . $activity_array[$i]['start_time']. "</td>";
            echo "<td id='loaction".$activity_array[$i]['activity_id']."'>" . $activity_array[$i]['location']. "</td>";
            echo "<td id='max_followers".$activity_array[$i]['activity_id']."'>" . $activity_array[$i]['max_followers']. "</td>";
            $followers = $following->getGroupPeople($activity_array[$i]['activity_id']);
            $number = count($followers);
            for($j=0;$j<$number;$j++){
              
              echo "<input hidden name='follower".$activity_array[$i]['activity_id']."' value=". $followers[$j]['email'] .">";
              echo "<input hidden name='followerfname".$activity_array[$i]['activity_id']."' value=". $followers[$j]['fname'] .">";
              echo "<input hidden name='followerlname".$activity_array[$i]['activity_id']."' value=". $followers[$j]['lname'] .">";
            }
           
            echo "<input hidden id='description".$activity_array[$i]['activity_id']."' value = '".$activity_array[$i]['description']."'/>";
            echo "<td>  <div class='btn-group' role='group' aria-label='...'>
                      <button type='button' onclick='edit(this)' id='edit".$activity_array[$i]['activity_id']."'' class='btn btn-default'>edit</button>
                      <button type='button' onclick='addimage(this);' id='image".$activity_array[$i]['activity_id']."' class='btn btn-default'>add more image</button>
                      <button type='button' onclick='showfollower(this);' id='showfollower".$activity_array[$i]['activity_id']."' class='btn btn-default'>followers</button>
                       </div> </td>";
            echo "</tr>";
        } 

        
 
        ?>

        </tbody>

    </table>

    <div>
      <ul class="nav nav-pills">
        <li role="presentation" class="active"><a href="./index.php">return</a></li>
      </ul>
    </div>


</div>



</body>

<!-- jQuery -->
<script src="../assets/js/jquery-1.11.1.js"></script>
<script src="../assets/js/moment-with-locales.js"></script>
<script src="../assets/js/bootstrap-datetimepicker.js"></script>


<!-- Bootstrap Core JavaScript -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
    function edit(a){
        $('#editModal').modal('show');
        document.getElementById('title').value = document.getElementById('title'+a.id.substring(4,a.lenght)).innerHTML;
        document.getElementById('location').value = document.getElementById('loaction'+a.id.substring(4,a.lenght)).innerHTML;
        document.getElementById('description').value = document.getElementById('description'+a.id.substring(4,a.lenght)).value;
        document.getElementById('max_followers').value = document.getElementById('max_followers'+a.id.substring(4,a.lenght)).innerHTML;
        document.getElementById('edit_activity_id').value = a.id.substring(4,a.lenght);
    }
    function addimage(a){
         $('#addmore').modal('show');
         document.getElementById('add_activity_id').value = a.id.substring(5,a.lenght);

    }
    function showfollower(a){
       $('#showfollower').modal('show');
       if(document.getElementsByName('follower'+a.id.substring(12,a.lenght)).length>0){
        var info = "<tr><td>email</td><td>last name</td><td>first name</td></tr>";
         info =info + "<tr>";
         for (var i = 0; i < document.getElementsByName('follower'+a.id.substring(12,a.lenght)).length; i++) {
           info = info +"<td>"+ document.getElementsByName('follower'+a.id.substring(12,a.length))[i].value +" </td> <td>"+ document.getElementsByName('followerfname'+a.id.substring(12,a.length))[i].value+" </td><td> "+document.getElementsByName('followerlname'+a.id.substring(12,a.length))[i].value;
          info = info + "</td></tr>";
         }

         document.getElementById('body_follower').innerHTML = info;
          
       }else{
          document.getElementById('body_follower').innerHTML =  "";
       }
       
    }
</script>
</html>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Edit Activity</h4>
      </div>
      <div class="modal-body">
        <form method="POST" id="editModalform" action="./editActivity.php" name="editModalform" enctype="multipart/form-data">
          <div class="form-group">
            <label for="title" class="control-label">Title:</label>
            <input type="text" class="form-control" name="title" id="title">
            <input type="text" hidden id="edit_activity_id"  name="edit_activity_id"/>
          </div>
           <div class="form-group">
            <label for="post_location" class="control-label">Location:</label>
            <input type="text" class="form-control" name="location" id="location">
          </div>
          <div class="form-group">
            <label for="post_description" class="control-label">Description:</label>
            <textarea class="form-control" name="description" id="description"></textarea>
          </div>
          <div class="form-group">
            <label for="max_followers" class="control-label">Max followers:</label>
            <input type="text" class="form-control" name="max_followers" id="max_followers">
          </div>
          <div class="form-group">
              <div id="errorMsg" class="alert alert-danger" role="alert" style="display:none;"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" form="editModalform" value="Submit" class="btn btn-primary">Send message</button>
          </div>
           
        </form>
        
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="addmore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Add more image</h4>
      </div>
      <div class="modal-body">
        <form method="POST" id="addmoreform" action="./editActivity.php" name="addmoreform" enctype="multipart/form-data">
           <div class="form-group">
            <label for="image" class="control-label">Image:</label>
            <input type="file" class="form-control-file" name="image" id="image">
            <input type="text" hidden id="add_activity_id" name="add_activity_id"/>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" form="addmoreform" value="Submit" class="btn btn-primary">Send message</button>
          </div>
           
        </form>
        
      </div>

    </div>
  </div>
</div>
<div class="modal fade" id="showfollower" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Followers</h4>
      </div>
      <div class="modal-body" >
        <table class = "table" id="body_follower">

        </table>
      </div>

    </div>
  </div>
</div>

<?php
       if(isset($_POST['add_activity_id'])){
            echo "enter";
            $image = addslashes($_FILES['image']['tmp_name']);
            $name = addslashes($_FILES['image']['name']);
            $image = file_get_contents($image);
            $image = base64_encode($image);
            $activity_id = $_POST['add_activity_id'];
            $modify_image = new activity_images();
            $modify_image->addImage($activity_id, $name, $image);
        }
 
        if(isset($_POST['edit_activity_id'])){
            $activity_id = $_POST['edit_activity_id'];
            $title = $_POST['title'];
            $location = $_POST['location'];
            $description = $_POST['description'];
            $max_followers = $_POST['max_followers'];
            $activity = new activity();
            $activity->updateEvent($activity_id, $title, $description, $location, $max_followers); 
        }
?>
