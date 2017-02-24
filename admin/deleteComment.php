<?php 
    if(isset($_GET['id'])){
        require("../inc/db_connect.php");

        $delete = "DELETE FROM comments WHERE comment_id='" . $_GET['id'] . "';";
        if(!mysqli_query($con,$delete)){
          die('Error: ' . mysql_error());
        }
    }
    
    header("Location: comments.php");
?>