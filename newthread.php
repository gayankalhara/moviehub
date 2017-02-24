<?php 
  require('inc/session.php');
  require("inc/db_connect.php");
?>

<!-- 
=================================================
 											                           
 		ITA Group Project						                 	
 		Copyright (c) 2014. SLIIT. 				           
 		All Rights Reserved. 					               
 												                         
 		Team Members: 							                 
 			(*) Gayan Kalhara					                 
 			(*) Hasitha Jayasinghe				             
 			(*) Udesh Hewagama					               
 			(*) Sehan Dananjaya					               
 			(*) Dhanushka Udayanga				             
 			(*) Kalif Rahim						                 
 			(*) Buddhika Prasanna				               
 			(*) Milantha Ekanayake				             
 												                         
=================================================
                                              -->
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
	<title>Movie Hub</title>

	<link rel="stylesheet" type="text/css" href="css/main.css"/>
	<link rel="icon" type="image/png" href="img/favicon.png" />

  <style>
    
  </style>
</head>

<body>

<?php 
include('inc/header.php');?>

<div class="content" style="margin-top: 30px;">
<h1 style="margin-bottom: 8px;">Forum</h1>

<?php 
  $query = "select * from categories;";
  $query_con = mysqli_query($con,$query);
    while ($row= mysqli_fetch_array($query_con)){ ?>
<div class="topic">
  <img style="width: 65px; padding: 18px;" src="img/forum-icon.png">
  <div style="display: inline-block; vertical-align: top; margin-top: 22px;">
    <a href="topics.php?id=<?php echo $row['cat_id']; ?>"><h3><?php echo $row['cat_name']; ?></h3></a>
    <h5 style="color: #bfbfbf;"><?php echo $row['cat_description']; ?></h5>
  </div>
</div>
  <?php } ?>

</div>

<?php include('inc/footer.htm'); ?>
</body>
</html>