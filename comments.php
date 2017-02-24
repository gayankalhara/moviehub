<?php
  require('inc/session.php');
  require("inc/db_connect.php");

  ?>

<?php 
    $movie_id=1;
    

    ?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
    <title>Movie Hub</title>
    

    <link rel="stylesheet" type="text/css" href="css/main.css"/>


<style>
    
    .header{
        display: inline-block;
        margin-bottom: 10px;

    }


    .comment{
        display: block;
        height: 90px;
        margin-bottom: 10px;
    }

    .userPic{
        float: left;
        
    }

    .userPic img{
        border-radius: 10px;
        border: 2px solid #333;
        width: 80px;
        height: 80px;
    }

    .userName{
       
    }

    .comment-area{
        float: right;
        width: 89%;
        margin-left: 10px;
    }

    .comment-text{
        display: block;
        border-radius: 10px;

    }

    .comment-text textarea{
        border-radius: 10px;
        padding: 10px;

    }

    .delete{
        float: right;

    }

</style>

</head>

<body>
<?php include('inc/header.php');?>
<div class="content" style="margin-top: 35px;">

<?php

# Count No of Comments
    
    $CountValue = 0;
    $count = "select Count(comment_id) as CountValue from comments where movie_id=$movie_id;";
    $count_no = mysqli_query($con,$count);
    while ($k= mysqli_fetch_array($count_no)){
        $CountValue = $k['CountValue'];
    }


?>

<div class="header">
    <header>
        <h2>Comments <span style="color: #1e86de;">(<?php echo $CountValue; ?>)</span></h2>
    </header>
</div>


<?php
    $select_comments="select * from comments where movie_id=$movie_id;";
    $comments= mysqli_query($con,$select_comments);
    $member_name= "select First_Name, Last_Name from comments,members where comments.member_id=members.MemberID AND movie_id=$movie_id;";
    $member= mysqli_query($con,$member_name);

    $nextID = $CountValue+1;

    include('inc/getTimeAgo.php');

# Getting Previous Comments
 while (($row1= mysqli_fetch_array($member)) & ($row= mysqli_fetch_array($comments))) { ?>
    <div class="comment">
        <div class="userPic"><img src="img/users/default.jpg"></div>
        <div class="comment-area">
            <div class="userName">
                <h4 style="display: inline-block;"><?php echo $row1['First_Name'] . " " . $row1['Last_Name']; ?></h4><h6 style="display: inline-block; margin-left: 5px; color: #46d7f6;"><?php echo getTimeAgo($row['time']); ?></h6>
            </div>
            <div class="comment-text">
                <?php echo $row['comment']; ?> 
            </div>
            <form name="deleteComment" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="delete">
                    <input type="submit" name="btnDeleteComment<?php echo $row['comment_id'];?>"  class="blue-button" value="X">
                </div>       
            </form>
        </div>
    </div>

<?php } ?>



<?php
# Implemening Delete Button
    if ($_SERVER['REQUEST_METHOD']=='POST') {

        $delCommentID=0;
        $delCount = "select comment_id from comments where movie_id=$movie_id;";
        $delCountQuery = mysqli_query($con,$delCount);
        while ($q = mysqli_fetch_array($delCountQuery)){
            $z = $q['comment_id'];

            $zz = "btnDeleteComment" . $z;

            if(isset($_POST[$zz])){

                $delete = "delete from comments where comment_id='" . $z . "'";

                if (!mysqli_query($con,$delete)) {
                    die('Error:'.mysql_error());
                }

                    
                else{
                    echo '<script>location.reload();</script>';
                }

            } 
        }
    }


?>

<!-- Getting User Comments -->
<?php 
$username="Gayan Kalhara";

if (!isset($_SESSION['userlogin'])){ ?>


<div class="comment">
        <div class="userPic">
            <img src="img/users/default.jpg">
        </div>

        <div class="comment-area">
            <div class="userName">
                <?php echo "<h4>$username</h4>" ?>
            </div>

            <form name="addComment" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">

            <div class="comment-text">
                <textarea name="comment" style="width: 97%; height:80px ;" placeholder="Place Your Comment Here..." ></textarea>
            </div>
            <div class="delete">
                <input type="submit" name="add_comment" class="blue-button" value="Add Comment">

            </form>
            </div>
        </div>
</div>

<?php }

else{
echo '<h2 style="display:inline-block">Please login to comment..!</h2>';
echo '<input type="button" name="login" value="Login" class="blue-button" style ="height:30px; width:80px; display:inline-block; margin-left:50px;">';
}
 ?>


<?php
#Implementing Comment Button

    
  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['add_comment'])){

    $comment = $_POST["comment"];

    if (($comment!=" ") && ($comment!= null)) {


        if (isset($_POST["add_comment"])) {
            $insert = "insert into comments(movie_id, member_id, comment) VALUES('" . $movie_id . "', '45', '$comment');";
            if (!mysqli_query($con, $insert)){
                die('Error :'.mysql_error());
            }
            else{
                echo '<script>location.reload();</script>';
            }
        }
      
    }

    else {

            $error = "Fill the Comment Field";
            echo $error;

    }
}

?>


</div>

<?php include('inc/footer.htm');?>

</body>

</html>
