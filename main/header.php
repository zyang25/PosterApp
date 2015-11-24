<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../assets/css/1-col-portfolio.css" rel="stylesheet">

</head>

<body>

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
            <li class="active"><a href="index.php">Home</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php
            if(isset($_SESSION['user_id'])){

              echo '<li><a href="#">'.$_SESSION['email'].'</a></li>';
              echo '<li><a href="logout.php">  Logout</a></li>';

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