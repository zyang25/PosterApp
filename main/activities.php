<?php 
    session_start();
    require_once('data.php');
    if(!isset($_SESSION['user_id'])){
        header('Location: ../index.php');
    }
    $images = new activity_images();
    $act_image = new activity();
    $result = $images->retrieveImage($_GET['activity_id']);
    $oneImage = $act_image->getOneImage($_GET['activity_id']);
    $image_path = '../assets/img/activities-large-pic/'.$oneImage['image'];
    $count_image = count($result) + 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <script src="../assets/js/jquery-1.11.1.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap-datetimepicker.js"></script>
    <!-- Custom CSS -->
    <link href="../assets/css/1-col-portfolio.css" rel="stylesheet">

</head>
    
<body>
    <?php
        include('nav.php');
    ?>

    <input id = "0" type="hidden" value= "<?php echo $image_path?>">

    <table>
    <?php
    for($i = 1; $i < $count_image; $i++){
        $real_i = $i - 1;
    ?>    
        <tr>
            <td>
                <input id = "<?php echo $i ?>" type="hidden" value= "<?php echo $result[$real_i]['image']?>">
            </td>
        </tr>
        <?php
    }
    ?>
    </table>

    <input type="hidden" id = "image_number" value="<?php echo $count_image ?>">
    <input type="hidden" id = "activity_id" value="<?php echo $_GET['activity_id'] ?>">
    <input type="hidden" id = "user_id" value="<?php echo $_SESSION['user_id'] ?>">

        <!-- Page Content -->
            <div class="container">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" id = "activity_name"></h1>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-7">
                            <img height="600" width="600" class="img-responsive" id = "image_area" src="<?php echo $image_path?>" alt="">                            
                            <!-- <img height="600" width="600" class="img-responsive" id = "image_area" src="data:image;base64,<?php echo $result[0]['image']?>" alt="">  -->  
                            <!-- handle no image upload -->
                    </div>
                    <div class="col-md-5">
                        <table>
                            <tr><td><h3><label for = "location">Location:</label></h3></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><h4 id = "location"></h4></td></tr>
                            <tr><td><h3><label for = "time_stamp">Time:</label></h3></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><h4 id = "time_stamp"></h4></td></tr>
                            <tr><td><h3><label for = "description">Description:</label></h3></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><h4 id = "description"></h4></td></tr>                            
                        </table>
                        <br> 
                        <br> 
                        <a class="btn btn-primary" id = "follow_status">Loading...</a>&nbsp;&nbsp;&nbsp;&nbsp;<span id = "remaining"></span>   
                    </div>
                </div>
                <!-- /.row -->

                <!-- Pagination handle multiple images-->
                <div class="row text-center">
                    <div class="col-lg-12">
                        <ul class="pagination" id = "change_image">  
                            <li>
                                <a class ="reply">&laquo;</a>
                            </li>
                            <?php
                                for($i = 0; $i < $count_image; $i++){
                                    $index = $i + 1;
                                    echo "<li><a class='reply' data-doc_value=' ".$index."'>". $index ."</a></li>";
                                }
                            ?>
                            <li>
                                <a class ="reply">&raquo;</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.row -->

                <!-- Footer -->
                <footer>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>Copyright &copy; Vjoin 2015</p>
                        </div>
                    </div>
                    <!-- /.row -->    
                </footer>

            </div>
            <!-- /.container -->
            
    </body>
    <!-- jQuery -->                
        <script src="../assets/js/load_activity.js"></script>
        <?php
            require_once('addActivity.php');
        ?>
</html>
