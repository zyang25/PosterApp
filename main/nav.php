<!-- Fixed navbar -->
<div class="row">
  <div class="container">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://localhost/vjoin/main/index.php">Vjoin</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul id="nav_home" class="nav navbar-nav">
          
          <li class="active"><a href="index.php">Home</a></li>
          </ul>
          <ul id="nav_post" class="nav navbar-nav">
             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ActivityManage <span class="caret"></span></a>

             <ul class="dropdown-menu">
               <li><a data-toggle="modal" data-target="#myModal">Post a activity</a></li>
               <li><a href="editActivity.php">Manage my activities</a></li>
             </ul>             
            </li>
            <li><a href="manageAppliedActivity.php">Applied Activities</a></li>
          </ul>
          <ul id="nav_chat" class="nav navbar-nav">
            <li><a href="../chat/friendList.php">Chat</a></li>
          </ul>
            
        <?php
                $userModel = new UserModel();
                $res = $userModel->getuserIsadminById($_SESSION['user_id']);
                if($res[0]['is_admin']==1){
                    echo " <ul class='nav navbar-nav'>";
                    echo " <li class='dropdown'>";
                    echo "  <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>userManage <span class='caret'></span></a>";
                    echo "<ul class='dropdown-menu'>";
                    echo " <li><a href='../admin/UserList.php'>UserList</a></li>";
                     echo " <li><a href='../admin/ActivList.php'>ActivList</a></li>";
                    echo "</ul>";
                    echo " </li>";
                    echo " </ul>";
                    echo "<script>document.getElementById('nav_home').style.display='none';document.getElementById('nav_post').style.display='none';</script>";
                }
              ?>


          <ul class="nav navbar-nav navbar-right">
            <?php
            if(isset($_SESSION['user_id'])){

              echo'
                <div class="collapse navbar-collapse" id="myNavbar">
                  <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>'.$_SESSION['email'].'</a>
                      <ul class="dropdown-menu">
                        <li><a href="profile.php">Edit Profile</a></li>
                          <li><a href="change_password.php">Change Password</a></li>
                        <li><a href="logout.php">Log out</a></li>
                      </ul>
                    </li>
                 </ul>
                </div>
    
              ';

            }else{
              echo '
                <li><a href="register.php">Sign up <span class="sr-only">(current)</span></a></li>
                <li><a href="login.php">Login <span class="sr-only">(current)</span></a></li>
              ';
            }
            ?>
            
          </ul>
          </div><!--/.nav-collapse -->
        </div>
      </nav>
      
    </div>
    
  </div>