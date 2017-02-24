<?php 
    if(isset($_GET['id'])){
        require("../inc/db_connect.php");

        $update = "UPDATE comments SET approved=1 WHERE comment_id=" . $_GET['id'] . ";";
        $query = mysqli_query($con,$update);
    }
    
    header("Location: comments.php");
?>
