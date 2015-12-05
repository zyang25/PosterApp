<?php
session_start();
require_once('data.php');

if(!isset($_SESSION['user_id'])){
header('Location: ../index.php');
}
$activity = new activity();
// Query recommanded activity
$activity_array = $activity->getActivityByCategory($_SESSION['user_id'],$_SESSION['preference']);
$recommanded_title = array();
$recommanded_img = array();
foreach ($activity_array as $key) {
    $img_path = '../assets/img/activities-large-pic/' . $key['image'];
    array_push($recommanded_img, $img_path);
    array_push($recommanded_title, $key['title']);
};

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vjoin</title>

    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/index.css" rel="stylesheet">

</head>

<body>

    <?php
        require_once('nav.php');

    ?>

    <!-- Half Page Image Background Carousel Header -->
        
        <header id="myCarousel" class="carousel slide">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
                <li data-target="#myCarousel" data-slide-to="5"></li>
            </ol>
            
            <!-- Wrapper for Slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <!-- Set the first background image using inline CSS below. -->
                    <div class="fill" style="background-image:url('<?php echo $recommanded_img[0]; ?>');"></div>
                    <div class="carousel-caption">
                        <h2><?php echo $recommanded_title[0]; ?></h2>
                    </div>
                </div>
                <div class="item">
                    <!-- Set the second background image using inline CSS below. -->
                    <div class="fill" style="background-image:url('<?php echo $recommanded_img[1]; ?>');"></div>
                    <div class="carousel-caption">
                        <h2><?php echo $recommanded_title[1]; ?></h2>
                    </div>
                </div>
                <div class="item">
                    <!-- Set the third background image using inline CSS below. -->
                    <div class="fill" style="background-image:url('<?php echo $recommanded_img[2]; ?>');"></div>
                    <div class="carousel-caption">
                        <h2><?php echo $recommanded_title[2]; ?></h2>
                    </div>
                </div>
                <div class="item">
                    <!-- Set the third background image using inline CSS below. -->
                    <div class="fill" style="background-image:url('<?php echo $recommanded_img[3]; ?>');"></div>
                    <div class="carousel-caption">
                        <h2><?php echo $recommanded_title[3]; ?></h2>
                    </div>
                </div>
                <div class="item">
                    <!-- Set the third background image using inline CSS below. -->
                    <div class="fill" style="background-image:url('<?php echo $recommanded_img[4]; ?>');"></div>
                    <div class="carousel-caption">
                        <h2><?php echo $recommanded_title[4]; ?></h2>
                    </div>
                </div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="icon-next"></span>
            </a>
        </header>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <br/><br/>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab"  data-categoryid="all">All</a></li>
                            <li><a href="#tab2" data-toggle="tab" id="category1" data-categoryid="1">Food</a></li>
                            <li><a href="#tab3" data-toggle="tab" id="category2" data-categoryid="2">Entertatinment</a></li>
                            <li><a href="#tab4" data-toggle="tab" id="category3" data-categoryid="3">Study</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="row">
                <br/>
                <br/>
                    <div class="activites_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-1"></div>
                                    <div class="col-xs-10 activities"></div>
                                    <div class="col-xs-1"></div>
                                </div>
                            </div>
                        </div> 
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
    <?
        require_once('addActivity.php');
    ?>

    <!-- jQuery -->
    <script src="../assets/js/jquery-1.11.1.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Script to Activate the Carousel -->

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

    <!-- Ajax query -->
    <script src="../assets/js/index_load_activity.js"></script>

</body>

</html>
