<?php 
  require('../inc/session.php');
  require("../inc/db_connect.php");

  # Count No of Comments
    
    $CountValue = 0;
    $count = "SELECT Count(comment_id) AS CountValue FROM comments WHERE approved=0;";
    $count_no = mysqli_query($con,$count);
    while ($k= mysqli_fetch_array($count_no)){
        $CountValue = $k['CountValue'];
    }
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
	<title>Movie Hub</title>

	<link rel="stylesheet" type="text/css" href="../css/main.css"/>
  <link rel="stylesheet" type="text/css" href="../css/admin.css"/>
	<link rel="icon" type="image/png" href="../img/favicon.png" />
  

  <style>
    table{
    margin-top: 10px;
    width: 100%;
  }

  th{
    border-top: 1px solid #2d2d2d;
    padding: 10px;
    background: url('../img/forum-header.jpg') repeat-x;
  }

  td{
    padding: 15px 15px 7px 15px;
    vertical-align: middle;
  }

  tr.thread{
    background-color: #111;
    border-top: 1px solid #2d2d2d;
    border-bottom: 1px solid #2d2d2d;
  }

  tr.thread:hover{
    background-color: #222;
  }

  .userPic{
    border-radius: 10px;
    border: 2px solid #2d2d2d;
    width: 66px;
    height: 66px;
    margin-right: 10px;
  }

  a{
    cursor: pointer;
    text-decoration: none !important;
  }

  a:hover{
    color: #ccc;
  }
    }

</style>
</head>

<body>


<?php include('inc/header.php');?>
  
<div class="content">

<h4>You have <?php echo $CountValue; ?> comments to approve.<br><br></h4>

<?php
# Getting Previous Comments#

    $select_comments="SELECT * from comments  WHERE approved=0;";
    $comments= mysqli_query($con,$select_comments);
    $member_name= "SELECT First_Name, Last_Name from comments,members where comments.member_id=members.MemberID;";
    $member= mysqli_query($con,$member_name);
    $movie_name= "SELECT MovieID, MovieName from comments,movies where comments.movie_id=movies.MovieID;";
    $movies= mysqli_query($con,$movie_name);

    $nextID = $CountValue+1;?>

    <table>

  <tr>
    <th>Comment</th>
    <th>Movie Name</th>
    <th>Actions</th>
  </tr>

  

  <?php

	include('../inc/getTimeAgo.php');


 while (($row1= mysqli_fetch_array($member)) & ($row= mysqli_fetch_array($comments)) & ($row3=mysqli_fetch_array($movies))) { ?>
    


	<tr class="thread">
	    
	    <td style="width: 40%;">
	      <div style="float: left;">
	        <img src="../img/users/default.jpg" class="userPic">
	      </div>
	      <div>
	        <h5 style="vertical-align: top; line-height: 21px;"><?php if(strlen($commentX=$row['comment'])<140){echo $commentX;} else{echo substr($commentX, 0, 140) . "...";};?></h5>
	        <p style="display: block; margin-top: 2px;" >by <a><?php echo $row1['First_Name'] . " " . $row1['Last_Name'] . "</a> " . getTimeAgo($row['time']) ;?></p>
	      </div>
	      
	      
	    </td>
	    <td style="width: 13%;"><?php echo $row3['MovieName'];?></td>
	    <td style="width: 13%;">
	    	
				<div class="delete">
                	<a href="approveComment.php?id=<?php echo $row['comment_id']?>"><input name="btnApproveComment" type="submit" class="blue-button" value="Approve"></a>
                    <a href="deleteComment.php?id=<?php echo $row['comment_id']?>"><input name="btnDeleteComment" type="submit" class="blue-button" value="Remove"></a>
                </div>     

	    </td>
	  </tr>

    

<?php } ?>

</table>

</div>

<?php include('../inc/footer.htm'); ?>

</body>
</html>
