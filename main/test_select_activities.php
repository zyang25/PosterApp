<?php 
    require_once('data.php');
    $modify_image = new activity_images();
?>


<!DOCTYPE type>
<html>
    <head></head>
    <body>

        <form method = "post" enctype="multipart/form-data">
        <br>
            <input type="text" name="activity_id">
            <br>
            <input type="file" name="image">
            <br><br>
            <input type="submit" name="submit" value = "upload"/>
        </form>
        <?php
            if(isset($_POST['submit'])){
                if(getimagesize($_FILES['image']['tmp_name']) == FALSE)
                {
                    echo "please select an image";
                }
                else{
                    $image = addslashes($_FILES['image']['tmp_name']);
                    $name = addslashes($_FILES['image']['name']);
                    $image = file_get_contents($image);
                    $image = base64_encode($image);

                    $activity_id = $_POST['activity_id'];
                    $modify_image->addImage($activity_id, $name, $image);
                }
            }

            $res = $modify_image->retrieveAllImage();
            //var_dump($res[0]['image']);
            echo '<img height="300" width="300" src="data:image;base64,'.$res[1]['image'].' ">  ';

        ?>

        <p>play</p>

        <table>
            <tr><td><a href="activities.php?activity_id=1">Visit our HTML tutorial</a></td></tr>   
        </table>
  
        <p>eat</p>

        <table>
            


        </table>

        <p>study</p>
        <table>



        </table>



    </body>
</html>