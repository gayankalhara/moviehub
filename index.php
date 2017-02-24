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
<?php
  require('inc/session.php');
  require("inc/db_connect.php");
  
  $display = "";
  if($userLoggedIn == true){ 
    $display = "Welcome " . $_SESSION['name'];
  }

  $popular=mysqli_query($con,"SELECT * from movies where Approved=0 ORDER BY View_Count ");
  $latest=mysqli_query($con,"SELECT * from movies where Approved=0 ORDER BY ReleaseDate desc");
  $sliderquery=mysqli_query($con, "SELECT  DISTINCT * From movies where approved = 0  ORDER BY RAND() LIMIT 25");
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
	<title>Movie Hub - Rent Movies Online</title>

	<link rel="stylesheet" type="text/css" href="css/main.css"/>
	<link rel="icon" type="image/png" href="img/favicon.png" />

  <!-- #BEGIN : Movie Slider -->
  <link href="css/jsCarousel-2.0.0.css" rel="stylesheet" type="text/css" />
  <script src="js/jquery-1.4.4.min.js" type="text/javascript"></script>
  <script src="js/jsCarousel-2.0.0.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function() { /* Initializes the MovieSlider */
      $('#carouselhAuto').jsCarousel({autoscroll: true, masked: false, itemstodisplay: getNoOfMovies(), orientation: 'h', autoscroll: true, circular: true });
    });
  </script>
  <!-- #END : Movie Slider -->

  <style>
    nav li#home{
      background-color: #000;
    }
  </style>
</head>

<body>

<?php include('inc/header.php'); ?>

<!-- #BEGIN : Under Header -->
<section id="under-header-wrap">
<div style="margin-top: 90px; width: 960px; margin-left: auto; margin-right: auto;">
  <div id="movie-search">
  <h2 style="margin-bottom:5px;">Find a movie...</h2>
         <div class="home-movie" >
            <form name="search" method="GET" action="search.php">
                  <input type="text" id="search" name="query" placeholder="Enter your Search Query here..." >
                  <input name="method" type="text" style="display: none;" value="NS">
                  <input type="submit" value="" class="search-button blue-button">
                  <input type="button" value="Advanced Search" class="blue-button" onclick="advancedSearch()">
            </form>
        </div>

        <div class="search-desc" style="margin-top:15px; width: 95%;">
          <p>Want American horror movies of the 2010 that at least have an average rating above a 6? You can find them by performing an <a href="advanced-search.php">advanced search</a>.</p>
        </div>

  </div>

  <?php if(isset($_SESSION['user']) && isset($_SESSION['password'])) { 

    $query = "select First_Name, ProfilePicURL from members WHERE UserName='" . $_SESSION['user'] . "';";
    $query_con = mysqli_query($con,$query);
    $topic=mysqli_fetch_array($query_con) or die(mysql_error());



    ?>
    <div id="login">
    <h3 style="font-size: 23px; margin-top:6px; margin-bottom:8px;">Welcome <?php echo $topic["First_Name"]; ?>!</h3>
    <div style="float: left;">
      <img style="border: 2px solid #434343; border-radius: 15px;" src="img/users/<?php echo $topic["ProfilePicURL"];?>">
    </div>
    <div style="display: inline-block; margin-left: 15px; vertical-align: middle; height: 94px;">
      <a href="my-account.php"><input style="margin-top: 8px; width: 130px; height: 32px;" type="button" class="blue-button" value="My Account"></a><br>
      <a href="logout.php"><input style="margin-top: 8px; width: 130px; height: 32px;" type="button" class="blue-button" value="Logout"></a>
    </div>
  </div>
  <?php } 
  else{ ?>

  <div id="login">
    <h2 style="margin-bottom:5px;">User Login</h2>
    <form name="login" method="POST" action="login.php">
             <input type="text" name="username" placeholder="User Name" /><br>
             <input type="password" name="password" placeholder="Password" /><br>
             <input type="submit" value="Login" class="blue-button">
             <a href="register.php" style="margin-top: 6px; margin-bottom: 0px; padding-bottom: 0px; margin-left: 9px;">Register</a>
    </form>
  </div>
  <?php } ?>
  

  

  

</div>

<div class="text-center" id="carouselhAuto" style="margin-top: 25px; overflow: hidden !important; ">
       <?php
       while ($slidermovies=mysqli_fetch_array($sliderquery))
       {
          $slideryear=substr($slidermovies["ReleaseDate"],0,4);
          $slidername=$slidermovies["MovieName"];
          $sliderimage=$slidermovies['ImageURL'];
          echo '<div>';
          echo  '<a href="movie.php?id=' . $slidermovies["MovieID"] . '">';
          echo  '<img width="114" height="179" alt="" src="img/movies/'.$sliderimage.'"/><br />';
          echo   '<span style = "line-height: 13px;width:110px;font-size:11px;display:inline-block">'.$slidermovies["MovieName"].'</span><span class="year" style = "font-size:12px;"">'.substr($slidermovies["ReleaseDate"],0,4).'</span></a></div>';
      }
      ?>
</div>

</section>
<div id="glow"></div>
<!-- #END : Under Header -->


<section id="latest" style="height:950px;">
<div class="movie-list content">
  <h2 style="margin-bottom: 15px;">Latest Movies</h2>

  <?php
  $count=1;
  while ($latmovie=mysqli_fetch_array($latest)) 
  {
    if($count<9)
    {
    $year=substr($latmovie["ReleaseDate"],0,4);
    $plot=$latmovie["Plot"];

    if(strlen($plot)>200){$plot=substr($plot, 0, 200) . "...";};
    
    $id=$latmovie["MovieID"];
    $imdb=$latmovie["IMDBId"];
    $trailer=$latmovie["YoutubeTrailer"];

    if(($count%4)==0)
      echo '<div class="column last"><header><span>'.$latmovie["MovieName"].'</span></header>';
    else
      echo '<div class="column"><header><span>'.$latmovie["MovieName"].'</span></header>';


   
    echo '<div class="movie-poster text-center">';
    echo '<div class="info center-text">';
    echo '<div class="inner-wrap">';
        echo '<br>';
        echo '<div class="movie-cat"><span>'.$year.'</span></div>';
        echo '<p style="font-size:13px;color: #fff" >'.$plot.'</p><br>';
        //echo '<img src="img/rating.png"><br><br>'
        echo '<a href="movie.php?id='.$id.'"> <input type="button" style="position:absolute; top:234px; left:40px" class="blue-button" value="View More Details" > </a>';
        echo '<a href="http://www.youtube.com/watch?v='.$trailer.'"><input style="position: absolute;left: 34px;top: 290px;" type="button" class="blue-button"  value="Watch Movie Trailer"></a>';
        echo '<a href="http://www.imdb.com/title/'.$imdb.'"><input style="position:absolute; top:262px; left:68px" type="button" class="blue-button" value="IMDB Link"></a>';
    echo '</div>';
    echo '</div>';
    echo '<div class="movie-poster"> <a href="#"><img src="img/movies/'.$latmovie["ImageURL"].'" alt="MoviePoster" width="222" height="329" /> </a> </div>';
    echo '</div>';
    echo '<footer><div class="movie-cat"><span>LKR 1200</span><input type="button" class="blue-button" value="Add to Cart"></footer></div>';
    }
    $count++;
  
  }
  ?>
</section>



<section id="popular">
<div class="movie-list content">
  <h2 style="margin-bottom: 15px;">Popular Movies</h2>

  <?php
  $count=1;
  while ($popmovie=mysqli_fetch_array($popular)) 
  {
    if($count<9)
    {
    $year=substr($popmovie["ReleaseDate"],0,4);
    $plot=$popmovie["Plot"];

    if(strlen($plot)>200){$plot=substr($plot, 0, 200) . "...";};



    $id=$popmovie["MovieID"];
    $imdb=$popmovie["IMDBId"];
    $trailer=$popmovie["YoutubeTrailer"];

   if(($count%4)==0)
      echo '<div class="column last"><header><span>'.$popmovie["MovieName"].'</span></header>';
    else
      echo '<div class="column"><header><span>'.$popmovie["MovieName"].'</span></header>';

    
    echo '<div class="movie-poster text-center">';
    echo '<div class="info center-text">';
    echo '<div class="inner-wrap">';
        echo '<br>';
        echo '<div class="movie-cat"><span>'.$year.'</span></div>';
        echo '<p style="font-size:13px;color: #fff" >'.$plot.'</p><br>';
        //echo '<img src="img/rating.png"><br><br>'
        echo '<a href="movie.php?id='.$id.'"> <input type="button" style="position:absolute; top:234px; left:40px" class="blue-button" value="View More Details" > </a>';
        echo '<a href="http://www.youtube.com/watch?v='.$trailer.'"><input style="position: absolute;left: 34px;top: 290px;" type="button" class="blue-button"  value="Watch Movie Trailer"></a>';
        echo '<a href="http://www.imdb.com/title/'.$imdb.'"><input style="position:absolute; top:262px; left:68px" type="button" class="blue-button" value="IMDB Link"></a>';
    echo '</div>';
    echo '</div>';
    echo '<div class="movie-poster"> <a href="#"><img src="img/movies/'.$popmovie["ImageURL"].'" alt="MoviePoster" width="222" height="329" /> </a> </div>';
    echo '</div>';
    echo '<footer><div class="movie-cat"><span>LKR 1200</span><input type="button" class="blue-button" value="Add to Cart"></footer></div>';
    }
    $count++;
  }
  ?>
</section>

<?php 
include('inc/footer.htm'); 
?>

<script src="js/main.js" type="text/javascript"></script>
</body>
</html>