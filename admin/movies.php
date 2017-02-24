<?php 
  require('../inc/session.php');
  require("../inc/db_connect.php");
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
  .invisible{
    display: none;
  }
</style>

  <script type="text/javascript">
    function insertDemoData(){
      document.getElementById('movie-name').value = "The Terminal";
      document.getElementById('release-date').value = "04-11-2014";
      document.getElementById('imdb-id').value = "tt3250235";
      document.getElementById('imdb-rating').value = "5";
      document.getElementById('plot').value = "The quick brown fox jumps over the lazy dog";
      document.getElementById('youtube-trailer').value = "http://www.youtube.com/v?ds3fxssf";
      document.getElementById('image-url').value = "the-terminal.jpg";
    }

    function showDetails() 
    {

    
document.getElementById("movie-name").value=document.getElementById("MovieName").innerHTML;
document.getElementById("imdb-id").value=document.getElementById("IMDBId2").innerHTML;
document.getElementById("imdb-rating").value=document.getElementById("IMDBRating").innerHTML;
document.getElementById("text").value=document.getElementById("Plot").innerHTML;
document.getElementById("mpaa-rating").value=document.getElementById("MPAA").innerHTML;
document.getElementById("release-date").value=document.getElementById("Release").innerHTML;
  }
 </script>


</head>

<body>


<?php include('inc/header.php');?>
<?php

  include("../inc/secure.php");
  $result=mysqli_query($con,"SELECT max(MovieID) as lastmovie  FROM movies; ");
  $row = $result->fetch_assoc();
  $last = $row["lastmovie"];
  $last=$last+1;
  $success=$Eimdb_id =$Emovie_name=$Erelease_date =$Eimdb_rating=$Empaa_rating=$Edirector1=$Edirector2=$Ewriter1=$Ewriter2=$Ewriter3=$Ewriter4=$Ewriter5=$Eimage_url="";
  if($_SERVER['REQUEST_METHOD']=='POST' & isset($_POST['id']))
  {
    if(!empty($_POST["movie-name"]) && $_POST["release-date"] && $_POST["imdb-id"] && $_POST["imdb-rating"] && $_POST["text"] && $_POST["youtube-trailer"] && $_POST["image-url"])
    { 
        $movie_name = $_POST["movie-name"]; 
        $release_date = $_POST["release-date"]; 
        $release_date = date("Y-m-d", strtotime($release_date));
        $imdb_id = $_POST["imdb-id"];
        $mpaa_rating=$_POST["mpaa-rating"];
        $imdb_rating = $_POST["imdb-rating"];
        $plot = $_POST["text"];
        $director1=$_POST["director1"];
        $writer1=$_POST["writer1"];
        $youtube_trailer = $_POST["youtube-trailer"]; 
        $image_url = $_POST["image-url"];





        if(!empty($_POST["director2"]))
          {
            $director2 = $_POST["director2"];
            if(!preg_match("/^[a-zA-Z ]*$/",$director2))
                {
                  $Edirector2="* Enter Valid Name";
                }
          }

        
        if(!empty($_POST["writer2"]))
          {
            $writer2=$_POST["writer2" ];
            if(!(preg_match('/^[a-zA-Z ]*$/',$writer2)))
                {
                  $Ewriter2="* Enter Valid Name";
                }
          }
        if(!empty($_POST["writer3"]))
          {
            $writer3=$_POST["writer3"];
            if(!(preg_match('/^[a-zA-Z ]*$/',$writer3)))
                {
                  $Ewriter3="* Enter Valid Name";
                }
          }
        if(!empty($_POST["writer4"]))
          {
            $writer4=$_POST["writer4"];
            if(!(preg_match('/^[a-zA-Z ]*$/',$writer4)))
                {
                 $Ewriter4="* Enter Valid Name";
                }
          }
        if(!empty($_POST["writer5"]))
          {
            $writer5=$_POST["writer5"];
            if(!(preg_match('/^[a-zA-Z ]*$/',$writer5)))
                {
                 $Ewriter5="* Enter Valid Name";
                }
          }

        if(!(preg_match('/^[a-z0-9]*$/',$imdb_id)) && (strlen($imdb_id!=9)))
        {
          $Eimdb_id = " * Enter a valid imdb ID";
        }
        if($imdb_rating>10 )
        {
          $Eimdb_rating = " * Enter a valid imdb Rating";
        }
        if(($mpaa_rating!="G") && ($mpaa_rating!="PG") && ($mpaa_rating!="PG-13") && ($mpaa_rating!="R") && ($mpaa_rating!=""))
        {
          $Empaa_rating="* Enter a Valid MPAA Rating";
        }
        if(!(preg_match('/^[a-zA-Z ]*$/',$director1)))
        {
          $Edirector1="* Enter Valid Name";
        }
        if(!(preg_match('/^[a-zA-Z ]*$/',$writer1)))
        {
          $Ewriter1="* Enter Valid Name";
        }

        if(!(preg_match('/^[A-Za-z0-9 _ .-]*$/', $image_url)))
        {
          $Eimage_url="* Enter Valid Image name";
        }

          $sql = "INSERT INTO movies (MovieID, MovieName, ReleaseDate, IMDBId, IMDBRating, MPAA_Rating, Plot, YoutubeTrailer, ImageURL, Approved)   
                  VALUES('$last','$movie_name','$release_date','$imdb_id', '$imdb_rating', '$mpaa_rating', '$plot', '$youtube_trailer', '$image_url', '0',)";  
          if(null==($Eimdb_id) && null==($Eimdb_rating) && null==($Empaa_rating) && null==($Edirector1) && null==($Edirector2) && null==($Ewriter1) && null==($Ewriter2) && null==($Ewriter3) && null==($Ewriter4) && null==($Ewriter5) && null==($Eimage_url))
          {

                if(!mysqli_query($con,$sql))
                {
                  die('Error: ' . mysqli_error($con));
                }

              if(isset($_POST['gAction']))
                {
                  $qact="INSERT INTO movies_genre values ('$last', 'Action') ";
                  mysqli_query($con,$qact);
                  echo $last;
                }
              if(isset($_POST['gAnimation']))
                {
                  $qanim="INSERT INTO movies_genre values ('$last', 'Animation') ";
                  mysqli_query($con,$qanim);
                }
              if(isset($_POST['gChildren']))
                {
                  $qchil="INSERT INTO movies_genre values ('$last', 'Children') ";
                  mysqli_query($con,$qchil);
                }
              if(isset($_POST['gComedy']))
                {
                  $qcom="INSERT INTO movies_genre values ('$last', 'Comedy') ";
                  mysqli_query($con,$qcom);
                }
              if(isset($_POST['gDrama']))
                {
                  $qdra="INSERT INTO movies_genre values ('$last', 'Drama') ";
                  mysqli_query($con,$qdra);
                }
              if(isset($_POST['gHorror']))
                {
                  $qhor="INSERT INTO movies_genre values ('$last', 'Horror') ";
                  mysqli_query($con,$qhor);
                }
              if(isset($_POST['gSciFi']))
                {
                  $qsci="INSERT INTO movies_genre values ('$last', 'Sci-Fi') ";
                  mysqli_query($con,$qsci);
                }

                $qwrite1="INSERT INTO movies_writers values ('$last', '$writer1')";
				          mysqli_query($con,$qwrite1);
                if(!empty($writer2))
                	{
                	$qwrite2="INSERT INTO movies_writers values ('$last', '$writer2')";
                	mysqli_query($con,$qwrite2);
                	}



               	if(!empty($writer3))
               	{
               		$qwrite3="INSERT INTO movies_writers values ('$last', '$writer3')";
               		mysqli_query($con,$qwrite3);
               	}

               	if(!empty($writer4))
               	{
               		$qwrite4="INSERT INTO movies_writers values ('$last', '$writer4')";
               		mysqli_query($con,$qwrite4);
               	}

               	if(!empty($writer5))
               	{
               		$qwrite5="INSERT INTO movies_writers values ('$last', '$writer5')";
               		mysqli_query($con,$qwrite5);
               	}



               	$qdirect1="INSERT INTO movies_directors values ('$last', '$director1')";
               	mysqli_query($con,$qdirect1);

               	if(!empty($director2))
               	{
               		$qdirect2="INSERT INTO movies_directors values ('$last', '$director2')";
               		mysqli_query($con,$qdirect2);
               	}


               echo '<script type="text/javascript">alert("Movie Added Successfully !); </script>';
          }
    }

           else 
                { 
                  echo "<script>alert('One Or more fields are not filled !'); </script>";
                  
                } 
      
  }
?>


<div class="content">

<h2 style="margin-left:100px; line-height:80px;">Add a Movie</h2>

<form class="add-movie" method="POST" action="<?php $_PHP_SELF ?>">
<table class="addmovietable">
  <tr>
  <td><label for="movie-name">Movie Name</label></td>
  <td><input name="movie-name" id="movie-name" type="text"></td>
      <td><p  id="error" name="Emovie-name"><?php echo $Emovie_name ;?></p><br></td></tr>
  <tr><td><label for="release-date">Release Date</label></td>
      <td><input name="release-date" id="release-date" type="date"></td>
      <td><p  id="error" name="Erelease-date"><?php echo $Erelease_date ;?></p><br></td></tr>
  <tr><td><label for="imdb-id">IMDB ID</label></td>
      <td><input name="imdb-id" id="imdb-id" type="text"></td>
      <td><p  id="error" name="Eimdb-id"><?php echo $Eimdb_id ;?></p><br></td></tr>
  <tr><td><label for="imdb-rating">IMDB Rating</label></td>
      <td><input name="imdb-rating" id="imdb-rating" type="number"  step="any" min="0" max="10"></td>
      <td><p  id="error" name="Eimdb-rating"><?php echo $Eimdb_rating ;?></p><br></td></tr>
  <tr><td><label for="mpaa-rating">MPAA Rating</label></td>
      <td><input name="mpaa-rating" id="mpaa-rating" type="text"></td>
      <td><p  id="error" name="Empaa-rating"><?php echo $Empaa_rating ;?></p><br></td></tr>
  <tr><td><label for="plot"><p  style="line-height:60px" >Plot</p></label></td>
      <td><textarea name="text" id="text" style="width:406px; height:100px"></textarea><br></td>
  <tr><td><label for="director1">Director 1</label></td>
      <td><input name="director1" id="director1" type="text"></td>
      <td><p  id="error" name="Edirector1"><?php echo $Edirector1 ;?></p><br></td></tr>
  <tr><td><label for="director2">Director 2</label></td>
      <td><input name="director2" id="director2" type="text"></td>
      <td><p  id="error" name="Edirector2"><?php echo $Edirector2 ;?></p><br></td></tr>

  <tr><td><label for="writer1">Writer 1</label>
      <td><input name="writer1" id="writer1" type="text">
      <td><p  id="error" name="Ewriter1"><?php echo $Ewriter1 ;?></p><br></td></tr>

  <tr><td><label for="writer2">Writer 2</label></td>
      <td><input name="writer2" id="writer2" type="text"></td>
      <td><p  id="error" name="Ewriter2"><?php echo $Ewriter2 ;?></p><br></td></tr>

  <tr><td><label for="writer3">Writer 3</label></td>
      <td><input name="writer3" id="writer3" type="text"></td>
      <td><p  id="error" name="Ewriter3"><?php echo $Ewriter3 ;?></p><br></td></tr>

  <tr><td><label for="writer4">Writer 4</label></td>
      <td><input name="writer4" id="writer4" type="text"></td>
      <td><p  id="error" name="Ewriter4"><?php echo $Ewriter4 ;?></p><br></td></tr>

  <tr><td><label for="writer5">Writer 5</label></td>
      <td><input name="writer5" id="writer5" type="text"></td>
      <td><p  id="error" name="Ewriter5"><?php echo $Ewriter5 ;?></p><br></td></tr>


  <tr><td><label for="youtube-trailer">YouTube Trailer</label></td>
      <td><input name="youtube-trailer" id="youtube-trailer" type="text"><br></td>

  <tr><td><label for="image-url">Image URL</label></td>
      <td><input name="image-url" id="image-url" type="text"></td>
      <td><p  id="error" name="Eimage-url"><?php echo $Eimage_url ;?></p><br></td></tr>
</table>
</br>
<table id="chktable" style="width:700px ;table-layout: fixed;overflow: hidden;" ><tr>
  <td><input  type="checkbox" name="gAction" value="Action" id="chkAction"><label for="chkAction">Action</label></td>
  <td><input  type="checkbox" name="gAnimation" value="Animation" id="chkAnimation"><label for="chkAnimation">Animation</label></td>
  <td><input  type="checkbox" name="gChildren" value="Children" id="chkChildren"><label for="chkChildren">Children</label></td>
  <td><input  type="checkbox" name="gComedy" value="Comedy" id="chkComedy"><label for="chkComedy">Comedy</label></td>
  <td><input  type="checkbox" name="gDrama" value="Drama" id="chkDrama"><label for="chkDrama">Drama</label></td>
  <td><input  type="checkbox" name="gHorror" value="Horror" id="chkHorror"><label for="chkHorror">Horror</label></td>
  <td><input  type="checkbox" name="gSciFi" value="SciFi" id="chkSciFi"><label for="chkSciFi">SciFi</label></td>
</tr></table>
</br>
 <center><input  type="submit" name="id" value="Submit"><input type="reset" value="Reset"><input type="button" value="Insert Demo Data" onclick="insertDemoData()"></center>


</form>


<h2>AutoFill Details</h2>

<form name="myform" class="autofill-details" method="POST" action="<?php $_PHP_SELF ?>">
  <label for="IMDBId">IMDB ID</label><input name="IMDBId" id="IMDBId" type="text"><br>
  <input name="getDetails" value="Get" type="submit" >
</form>

<div id="myDiv">

</div>

<?php
if ($_SERVER['REQUEST_METHOD']=='POST' & isset($_POST['getDetails']) & !empty($_POST['IMDBId']))
{
  $id=$_POST["IMDBId"];
$json=file_get_contents("http://www.omdbapi.com/?i=" . $id . '&t=');
$info=json_decode($json, true);

echo '<div class="invisible" id="MovieName">' . $info["Title"] .'</div>';
echo '<div class="invisible" id="IMDBId2">' . $info["imdbID"] .'</div>';
echo '<div class="invisible" id="IMDBRating">' . $info["imdbRating"] .'</div>';
echo '<div class="invisible" id="Plot">' . $info["Plot"] .'</div>';
echo '<div class="invisible" id="MPAA">' . $info["Rated"] .'</div>';
echo '<div class="invisible" id="Release">' . $info["Released"] .'</div>';
echo '<script>showDetails();</script>';
}



?>



</div>
</body>
</html>
