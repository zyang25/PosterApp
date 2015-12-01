<?php 
    session_start();
    require_once('addActivity.php');  //question!!
    require_once('data.php');
    if(!isset($_SESSION['user_id'])){
        header('Location: ../index.php');
    }
    $follow = new following();
    $res = $follow->getPersonalEventList($_SESSION['user_id']);   
    $count = count($res); 
    echo "<br/><br/><br/><br/><br/><br/>".$res[0]['activity_id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">   
        <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="../assets/css/1-col-portfolio.css" rel="stylesheet">
    </head>
    <body align="center">
        <?php
            include('nav.php');
            if($count > 1)      
                echo '<h2>The Following Activities are coming </h2>';
            else if($count == 1)
                echo '<h2>The Following Activity is coming </h2>';
            else 
                echo '<h2>You haven\'t chosen any activities yet!</h2>';
        ?>
        <br/>
        <ul>
            <?php    
                for($i = 0; $i < $count; ++$i){                           
                    echo '<ul><a href="activities.php?activity_id='.$res[$i]['activity_id'].'"><h4>Event Title:&nbsp;&nbsp;&nbsp; ' .$res[$i]['title']. '</h4></a>&nbsp;&nbsp;&nbsp;&nbsp;Start Time: &nbsp;&nbsp;&nbsp;&nbsp;'.$res[$i]['start_time'].'</ul>';
                    echo '<br/>';        
                }
            ?>
        </ul>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Vjoin 2015</p>
                </div>
            </div>
            <!-- /.row -->
        </footer> 
    </body>
</html>