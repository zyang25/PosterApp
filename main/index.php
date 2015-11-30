<?php
session_start();
require_once('data.php');
require_once('addActivity.php');
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


if(isset($_GET['category_id'])){
    global $activity;
    echo "<br/><br/><br/>";
    $category_id = $_GET['category_id'];
    $activity_query_array = $activity->getActivityByCategoryId($_SESSION['user_id'],$category_id);
    var_dump($activity_query_array);
    $query_title = array();
    $query_img = array();
    foreach ($activity_query_array as $key) {
        array_push($query_title, $key['title']);
    }
}else{
    // Query all activity
    global $activity;
    $id = 0;
    $activity_query_array = $activity->getActivityByCategoryId($_SESSION['user_id'],$id);
    var_dump($activity_query_array);
    // $query_array = array();
    // $query_title = array();
    // $query_description = array();
    // $query_img = array();
    // foreach ($activity_query_array as $key) {
    //     array_push($query_title, $key['title']);
    //     array_push($query_description, $key['description']);
    // }
}







?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="../assets/css/half-slider.css" rel="stylesheet">
    </head>
    <body>
        <?php
        include("nav.php");
        ?>
        <!-- Half Page Image Background Carousel Header -->
        <div class="row">
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
        </div>
        
        
        
        <div class="row">
            <div class="col-md-12">
                <br/><br/>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <ul class="nav nav-tabs">
                            <!-- <li class="active"><a href="#tab1" data-toggle="tab">All</a></li> -->
                            <li class="active"><a href="">All</a></li>
                            <li><a href="index.php?category_id=1">Food</a></li>
                            <li><a href="#tab3" data-toggle="tab">Entertatinment</a></li>
                            <li><a href="#tab4" data-toggle="tab">Study</a></li>
                        </ul>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1">
                        <br/><br/>
                        <!-- Page Features -->
                        <!-- <div class="row text-center"> -->
                            <!-- <div class="col-md-4 col-sm-6 hero-feature">
                                <div class="thumbnail">
                                    <img src="http://placehold.it/800x500" alt="">
                                    <div class="caption">
                                        <h3>Feature Label</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                        <p>
                                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                                        </p>
                                    </div>
                                </div>
                            </div> -->
                            <?php
                                $row_count = 0;
                                if(isset($activity_query_array)&&!empty($activity_query_array)){
                                    
                                    foreach ($activity_query_array as $key => $value) {
                                        $row_count = $row_count + 1;
                                        $img_path = '../assets/img/activities-large-pic/' . $value['image'];

                                        if($row_count % 3 == 0){
                                            echo '<div class="row">';
                                        }

                                            echo '<div class="col-md-4 col-sm-6 hero-feature">';
                                                echo '<div class="thumbnail">';
                                                    echo '<a href="activities.php?activity_id='.$value['activity_id'].'">';
                                                        echo '<img class="img-responsive" src="'.$img_path.'" alt="" style="width:100%;height:340px;">';
                                                    echo '</a>';
                                                    echo '<div class="caption">';
                                                        echo '<h2>'.$value['title'].'</h2>';
                                                        echo '<h4>'.$value['description'].'</h4>';
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        
                                        if($row_count % 3 == 0){
                                            echo '</div>';
                                        }
                                    }
                                }
                            ?>
                           
                            
                        <!-- </div> -->
                        <!-- /.row -->

                    </div>
                    <div class="tab-pane fade" id="tab2">Default 2</div>
                    <div class="tab-pane fade" id="tab3">Default 3</div>
                    <div class="tab-pane fade" id="tab4">Default 4</div>
                </div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="../assets/js/jquery-1.11.1.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- Script to Activate the Carousel -->
        <script>
        $('.carousel').carousel({
        interval: 5000 //changes the speed
        })
        </script>
    </body>
</html>