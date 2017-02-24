<?php 
  require('inc/session.php');
  require("inc/db_connect.php");
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title>Movie Hub</title>
 <?php 
if(!empty($_GET["id"]))
$ID=$_GET["id"] ;
else 
header('Location: index.php');

$result=mysqli_query($con,"SELECT *, COUNT(MovieID) as 'MovieCount' from movies where MovieID=$ID and Approved=0");
$viewcount=mysqli_query($con,"UPDATE movies set View_Count = View_Count + 1 where MovieID=$ID");
$movie=mysqli_fetch_array($result) or die(mysql_error());;
if($movie["MovieCount"]==0)
	header('Location: index.php');


$json=file_get_contents("http://www.omdbapi.com/?i=" .$movie["IMDBId"] . '&t=');

$info=json_decode($json,true) ;
  


if($info["Response"]=='False')
{
  $info['Actors']="Not Available";
  $info['Runtime']="Not Available";
  $info['Released']="Not Available";
  $info['Awards']="Not Available";
}




 ?>



	<link rel="stylesheet" type="text/css" href="css/main.css"/>
  <link rel="icon" type="image/png" href="img/favicon.png" />
	<meta charset="utf-8">


</head>

<body onload="rate()">

<script>
function rate()

{
  var starrate = document.getElementById("rating").innerHTML;
  starrate=Math.round(starrate*(125/10));
  document.getElementById("Stars1").style.width=starrate+"px";
}

</script>
<!-- #BEGIN : Header -->
<?php include('inc/header.php');?>



<!-- #END : Header -->

<!-- #BEGIN : Under Header -->
<section id="under-header-wrap-moviepage">
<div style="margin-top: 90px; width: 960px; margin-left: auto; margin-right: auto;">
  <div id="movie-search">
  <h2 style="margin-bottom:5px;">Find a movie...</h2>
         <div class="home-movie" >
	          <form name="search" method="GET" action="search.php">
	                <input type="text" name="query" placeholder="Enter your Search Query here..." />
	                <input type="submit" value="" class="search-button blue-button">
	                <input type="button" value="Advanced Search" class="blue-button">
	          </form>
        </div>

        <div class="" style="margin-top:15px; width: 95%;">
          <p>You can search by movie title, producer, director, year or any other attribute. Want American horror movies of the 2010 that at least have an average rating above a 6? You can find them by performing an advanced search.</p>
          <p style="color: #1e86de;"><strong>Note: </strong>An alternate way to submit your search is to press "Enter" key on your keyboard.</p>
        </div>

  </div>
  </section>

  <section  style="margin-top: 0px; width: 960px; margin-left: auto; margin-right: auto; float:bottom ">
  	<div id="MovieName">
	 <?php echo $movie["MovieName"];
	 echo '<p style="font-size:35px ;color:#289dff;display:inline-block;">'."(".substr($movie["ReleaseDate"],0,4) .")"."</div></p>";
   
   ?>
  	</div>


  </section>

<br>
  <section style="margin-top: 0px; width: 960px; margin-left: auto; margin-right: auto;">
  <!--____________________________________MPAA RATING -->
  	<div style="display:inline-block;font-size:25px; height:70px; line-height:70px;float:left; " >
      MPAA Rating : 
  		<?php $MPAA= $movie["MPAA_Rating"]; 
  		switch ($MPAA) {
  			case 'G':
  				echo '<img src='.'img/mpaa/g.png'.'>';
  				break;
  			case 'PG':
  				echo '<img src='.'img/mpaa/pg.png'.'>';
  				break;
  			case 'PG-13':
  				echo '<img  src='.'img/mpaa/pg-13.png'.'>';
  				break;
  			case 'R':
  				echo '<img src='.'img/mpaa/r.png'.'>';
  				break;
  			default:
  				echo '<img src='.'img/mpaa/g.png'.'>';
  				break;
  		}
  		?>
  	</div>
    <!--____________________________________MPAA RATING -->
    <div style="display:inline-block;font-size:25px; position: relative;left:-210px;height:70px; line-height:70px;">|</div>
  	<!-- _____________________________________________IMDB RATING-->
  	<div style="display:inline-block;font-size:25px; margin-left:90px;height:70px; line-height:70px;float:left;">
  	<p>IMDB Rating :&nbsp;</p>
  	</div>

		<div id="ratingcont">
  				<div style="position: relative; left:35px ;top:-7px;">	
    				<div style="position: absolute; top: 0; left: 0; " id="Stars1">
  						<img src="img/star-yellow.png">
  					</div>
	 				<div style="position: absolute; top: 0; left: 0; ;" id="Stars2">
  						<img src="img/star-black.png">
    				</div>
  				</div>
		</div>
    <div id="rating" >
          <?php  $rating = $movie["IMDBRating"] ;
          echo $rating;?>
    </div>  		


  </section>
<!-- _____________________________________________/IMDB RATING-->

    <div  style="margin-top: 0px; width: 960px; margin-left: auto; margin-right: auto;">
<?php $genres=mysqli_query($con,"Select * from movies_genre where MovieID=$ID");
while($genre=mysqli_fetch_array($genres))
  {
    echo '<div align="center" id="movgenre">'.$genre["Genre"].'</div>'.'<div style="float:left;display:inline-block;">&nbsp;&nbsp;&nbsp;</div>';
  }
  ?>

</div>
<div style="height:60px"></div>




<section style="margin-top: 0px; width: 960px; margin-left: auto; margin-right: auto;">

<div style="display:inline-block; width:400px;float:left ;padding-right:20px">
  <img width="325"src="<?php echo "img/movies/".$movie["ImageURL"] ?>"  alt="movie-poster" style="border:2px solid black; box-shadow: 7px 8px 16px black; border-radius:12px;"> 
  </div>
<table id="movie-table">


<tr><td colspan="2" id="moviedetailhead"><div >
<?php  $plot = $movie["Plot"] ; 
 echo $plot;?>
</div></td></tr>

<tr><td id="moviedetailhead">Written By : </td>
<td id="moviedetail"><div>
<?php
$writers=mysqli_query($con,"Select * from movies_writers where MovieID=$ID");
while($write=mysqli_fetch_array($writers))
	{
		echo $write["Writer"].",	";
	}
?>
</div></td></tr>

<tr><td id="moviedetailhead" > Directed By : </td><td id="moviedetail">
<?php
$director=mysqli_query($con,"Select * from movies_directors where MovieID=$ID");
while($direct=mysqli_fetch_array($director))
	{
		echo $direct["Directors"]."	    	";
	} ?>
</td></tr>

<?php


echo '<tr><td id="moviedetailhead" > Actors : </td>';
echo '<td id="moviedetail">'.$info["Actors"]. "</td></tr>";
echo '<tr><td id="moviedetailhead" > Runtime : </td>';
echo '<td id="moviedetail">'.$info["Runtime"]. "</td></tr>";
echo '<tr><td id="moviedetailhead" > Released : </td>';
echo '<td id="moviedetail">'.$info["Released"]. "</td></tr>";
echo '<tr><td id="moviedetailhead" > Awards : </td>';
echo '<td id="moviedetail">'.$info["Awards"]. "</td></tr>";



?>

<tr><td colspan="2"><center><input class="blue-button2" style="height:50px"type="button" value="Add To Cart"></center></td></tr>

</table>
<div style="font-size:30px; width: 960px; margin-left: auto; margin-right: auto;margin-top: 110px;margin-bottom:20px">Movie Trailer : <br> </div>
<div>
	<?php echo '<iframe width="960" height="540" src="http://www.youtube.com/embed/'. $movie["YoutubeTrailer"].'" alt= "Trailer"frameborder="0" allowfullscreen></iframe>';?>
</div>
</section>


</body>
<?php include('inc/footer.htm'); ?>

</html>
