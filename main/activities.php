<?php include("header.php"); 
if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
}
?>              
        <!-- Page Content -->
            <div class="container">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" id = "activity_name"> Activity Name need to be rendered
                            <small id = "category_name">category Name need to be rendered</small>
                        </h1>
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="col-md-7">
                            <img class="img-responsive" id = "image_area" src="../assets/img/activites/BBQ.jpg" alt="">
                            <!-- /.row modify this image src from database !!!!-->
                    </div>
                    <div class="col-md-5">                             
                        <h3 id = "location">Babbio Center 104</h3>  <!-- location-->
                        <h4 id = "time_stamp">Nov. 8, 2015, 6:47 p.m</h4> <!-- time-->
                        <p id = "description">Had the brisket and chicken, very tasty and moist.</p>      <!-- description-->
                        <br>

                        <a class="btn btn-primary" id = "follow_status" value = "unfollow">   follow</a>&nbsp;&nbsp;&nbsp;&nbsp;<span id = "remaining">45/60</span>
                    
                    </div>
                </div>
                <!-- /.row -->

                <!-- Pagination handle multiple images-->
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
        <script src="../assets/js/jquery-1.11.1.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</html>
