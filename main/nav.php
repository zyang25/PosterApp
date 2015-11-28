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
          <a class="navbar-brand" href="#">Vjoin</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="">Home</a></li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">postManager <span class="caret"></span></a>
             <ul class="dropdown-menu">
               <li><a data-toggle="modal" data-target="#myModal">Post a activity</a></li>
               <li><a href="#">Manage my activities</a></li>
             </ul>
             </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php
            if(isset($_SESSION['user_id'])){

              echo'
                <div class="collapse navbar-collapse" id="myNavbar">
                  <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>'.$_SESSION['email'].'</a>
                      <ul class="dropdown-menu">
                        <li><a href="../authentication/profile.php">Edit Profile</a></li>
                          <li><a href="../authentication/change_password.php">Change Password</a></li>
                        <li><a href="../authentication/logout.php">Log out</a></li>
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