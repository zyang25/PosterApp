<div class="modal fade"  style="display:none" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Post Activity</h4>
      </div>
      <div class="modal-body">
        <form method="POST" id="postform" action="./index.php" name="postform" enctype="multipart/form-data" onsubmit="return check();">
          <div class="form-group">
            <label for="title" class="control-label">Title:</label>
            <input type="text" class="form-control" name="title" id="title">
          </div>
           <div class="form-group">
            <label for="post_location" class="control-label">Location:</label>
            <input type="text" class="form-control" name="post_location" id="post_location">
          </div>
           <div class="form-group">
            <label for="start_time" class="control-label">StartTime:</label>
            <input type="text" name="start_time" class="form-control" id="datetimepicker1">
            <script src="../assets/js/jquery-1.11.1.js"></script>
             <script type="text/javascript">
                $(function () {
                    $('#datetimepicker1').datetimepicker({
                        format: 'YYYY-MM-DD HH:mm:ss'
                    });
                });
            </script>           
          </div>
          <div class="form-group">
            <label for="post_description" class="control-label">Description:</label>
            <textarea class="form-control" name="post_description" id="post_description"></textarea>
          </div>
          <div class="form-group">
            <label for="max_followers" class="control-label">Max followers:</label>
            <input type="text" class="form-control" name="max_followers" id="max_followers">
          </div>
          <div class="form-group">
            <label for="image" class="control-label">Image:</label>
            <input type="file" class="form-control-file" name="image" id="image">
          </div>
          <div class="form-group"> 
             <label for="category" class="control-label">Category:</label>
               
           <?php
           $category = new category();
           $allCategory = $category -> getAllCategory();
           echo "<select class='c-select' id='category' name='category'>";
             for ($i=0; $i < count($allCategory); $i++) { 
                  echo "<option value='".$allCategory[$i]['category_id']."'>".$allCategory[$i]['category_name']."</option>";
              }
            ?>
             </select>
             </div>
            <div class="form-group">
              <div id="errorMsg" class="alert alert-danger" role="alert" style="display:none;"></div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" form="postform" value="Submit" class="btn btn-primary">Send message</button>
          </div>
           
        </form>
        
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
  function check(){
    var title = document.getElementById("title").value;
    var post_location = document.getElementById("post_location").value;
    var image = document.getElementById("image").value;
    var start_time = document.getElementById("datetimepicker1").value;
    var post_description = document.getElementById("post_description").value;
    var max_followers = document.getElementById("max_followers").value;
  
    if(title.length==0){
        document.getElementById('errorMsg').style.display = "";
        document.getElementById('errorMsg').innerHTML = "plz input a title.";
        return false;
    }
     if(title.length>32){
        document.getElementById('errorMsg').style.display = "";
        document.getElementById('errorMsg').innerHTML = "plz input a short title.";
        return false;
    }
    if(post_location.length==0){
        document.getElementById('errorMsg').style.display = "";
        document.getElementById('errorMsg').innerHTML = "plz input a location.";
        return false;
    }
    if(post_description.length==0){
        document.getElementById('errorMsg').style.display = "";
        document.getElementById('errorMsg').innerHTML = "plz input a description.";
        return false;
    }
     if(post_description.length>255){
        document.getElementById('errorMsg').style.display = "";
        document.getElementById('errorMsg').innerHTML = "plz input a short description.";
        return false;
    }
    if(start_time.length==0){
        document.getElementById('errorMsg').style.display = "";
        document.getElementById('errorMsg').innerHTML = "plz input a start time.";
        return false;
    }

    if(image.length==0){
        document.getElementById('errorMsg').style.display = "";
        document.getElementById('errorMsg').innerHTML = "plz upload a image.";
        return false;
    }

    if(max_followers.length==0){
        document.getElementById('errorMsg').style.display = "";
        document.getElementById('errorMsg').innerHTML = "plz input a max_followers.";
        return false;
    }
    if(isNaN(max_followers)){
        document.getElementById('errorMsg').style.display = "";
        document.getElementById('errorMsg').innerHTML = "plz input a digit.";
        return false;
    }
     

  }
</script>
