<?php 
    session_start();
    //require_once('addActivity.php');
    include('nav.php');
    require_once('data.php');
    $images = new activity_images();
    $res = $images->retrieveImage($_GET['activity_id']);
    $count_image = count($res);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/1-col-portfolio.css" rel="stylesheet">

</head>

<body>
    <table>
    <?php
    for($i = 0; $i < $count_image; $i++){
    ?>    
        <tr>
            <td>
                <input id = "<?php echo $i ?>" type="hidden" value= "<?php echo $res[$i]['image']?>">
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
                            <img height="600" width="600" class="img-responsive" id = "image_area" src="data:image;base64,<?php echo $res[0]['image']?>" alt="">                            
                            <!--  echo '<img height="300" width="300" src="data:image;base64,'.$res[1]['image'].' ">  '; -->
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

                <hr>

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
</html>
