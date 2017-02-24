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
  table{
    margin-top: 10px;
    width: 100%;
  }

  th{
    border-top: 1px solid #2d2d2d;
    padding: 10px;
    background: url('img/forum-header.jpg') repeat-x;
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

  .inline{
    display: inline-block;
  }

  a{
    cursor: pointer;
    text-decoration: none !important;
  }

  a:hover{
    color: #ccc;
  }


  </style>
</head>

<body>

<?php 
include('inc/header.php');

include('db_connect.php');

$id=$_GET['id'];

    $queryA = "SELECT * FROM threads WHERE thread_topic_id=" . $id . ";";
    $query_conA = mysqli_query($con,$queryA);
    $thread=mysqli_fetch_array($query_conA) or die(mysql_error());

?>

<div class="content" style="margin-top: 30px;">


<h1><?php echo $thread['thread_name'];?></h1>

<table>

  <tr>
    <th>Title</th>
    <th>Views</th>
    <th>Replies</th>
  </tr>
  
  <?php
    include('inc/getTimeAgo.php');

    $query = "SELECT * FROM posts WHERE post_thread_id=" . $id . ";";
    $query_con = mysqli_query($con,$query);
    $posts=mysqli_fetch_array($query_con) or die(mysql_error());

    while($eachPost=mysqli_fetch_array($posts)){
      $user = "select First_Name, Last_Name from members WHERE MemberID=" . $eachPost['post_by'] . ";";
      $user_con = mysqli_query($con,$user);
      $userOut=mysqli_fetch_array($user_con) or die(mysql_error());

  ?>
  <tr class="thread">
    
    <td style="width: 74%;">
      <div style="float: left;">
        <img src="img/users/default.jpg" class="userPic">
      </div>
      <div class="inline">
        <a href="showthread.php?id=<?php echo $e['thread_id'];?>"><h4 style="vertical-align: top;"><?php echo $e['thread_name'];?></h4></a>
        <p style="display: block;" >by <a><?php echo $userOut['First_Name'] . " " . $userOut['Last_Name'];?></a></p>
        <p style="display: block;" >Posted <?php echo getTimeAgo($e['datetime']); ?></p>
      </div>
      
      
    </td>
    <td style="width: 13%;">436</td>
    <td style="width: 13%;">234</td>
  </tr>

<?php } ?>


</table>

</div>

<?php include('inc/footer.htm'); ?>
</body>
</html>