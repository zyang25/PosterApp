<?php include("header.php"); 
require_once('./data.php');

if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
}

?>

 

    <!-- Page Content -->
    <div class="container">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Page Heading
                    <small>Secondary Text</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">eat</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">play</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">study</button>
            </div>
        </div>
<hr>
        

        <!-- Project One -->
        <div class="row">
            <div class="col-md-7">
                <a href="#">
                    <img class="img-responsive" src="../assets/img/activites/BBQ.jpg" alt="">
                </a>
            </div>
            <div class="col-md-5">
                <h3>BBQ on campus & music</h3>
                <h3>Babbio Center 104</h3>
                <h4>Nov. 8, 2015, 6:47 p.m</h4>
                <p>Had the brisket and chicken, very tasty and moist.</p>
                <a class="btn btn-primary" href="#">follow</a>&nbsp;&nbsp;&nbsp;&nbsp;<span>45/60</span>
            </div>
        </div>
        <!-- /.row -->

        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li>
                        <a href="#">&laquo;</a>
                    </li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.row -->

        <hr>
        <?php
        if(isset($_POST['title'])){
            if ($_FILES["image"]["error"] > 0)
            {
              echo "Error: " . $_FILES["image"]["error"] . "<br />";
            }
            else
            {
              $filename = md5(uniqid(rand()));
              move_uploaded_file($_FILES["image"]["tmp_name"],"../assets/img/activites/" . $filename);
              echo 'enter'.$_POST['title'].$_POST['location'].$_POST['start_time'].$_POST['description'].$_POST['max_followers'].$_POST['category'];
              $activity = new activity();
              $activity -> addEvent($_POST['start_time'], $_POST['location'], $_POST['description'], "../assets/img/activites/". $filename, $_SESSION['user_id'], $_POST['category'], $_POST['max_followers'], $_POST['title']);
            }
            return;
        }
        ?>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2015</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../assets/js/moment-with-locales.js"></script>
    <script src="../assets/js/jquery-1.11.1.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap-datetimepicker.js"></script>


</body>

</html>
