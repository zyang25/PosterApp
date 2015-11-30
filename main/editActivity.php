<?php 

session_start();
require_once('data.php');
if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <link href="../assets/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/half-slider.css" rel="stylesheet">

</head>

<body>


<div>
	
	

    <table class="table">

        <thead>

            <tr>

                <th>Row</th>

                <th>First Name</th>

                <th>Last Name</th>

                <th>Email</th>

            </tr>

        </thead>

        <tbody>

            <tr>

                <td>1</td>

                <td>John</td>

                <td>Carter</td>

                <td>johncarter@mail.com</td>

            </tr>

            <tr>

                <td>2</td>

                <td>Peter</td>

                <td>Parker</td>

                <td>peterparker@mail.com</td>

            </tr>

            <tr>

                <td>3</td>

                <td>John</td>

                <td>Rambo</td>

                <td>johnrambo@mail.com</td>

            </tr>

        </tbody>

    </table>


</div>



</body>

<!-- jQuery -->
<script src="../assets/js/jquery-1.11.1.js"></script>
<script src="../assets/js/moment-with-locales.js"></script>
<script src="../assets/js/bootstrap-datetimepicker.js"></script>


<!-- Bootstrap Core JavaScript -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

</html>

