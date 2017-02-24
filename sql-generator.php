<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
	<title>Movie Hub</title>

	<link rel="stylesheet" type="text/css" href="css/main.css"/>
  <link rel="stylesheet" type="text/css" href="css/admin.css"/>
	<link rel="icon" type="image/png" href="img/favicon.png" />
  
</head>

<body>

<div class="content">
<h2>SQL Generator</h2>
<form class="autofill-details" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <label for="IMDBId">IMDB ID</label><input name="IMDBId" id="IMDBId" type="text"><br>
  <label for="index">ID</label><input name="index" id="index" type="text" value="0"><br>
  <label for="youtube">Youtube Trailer</label><input name="youtube" id="youtube" type="url" value="http://www.youtube.com/watch?v=xxxxxxxxxxx"><br>
  <input name="getDetails" value="Get" type="submit">
</form>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 

  $imdbID = $_POST['IMDBId'];
  $json=file_get_contents("http://www.omdbapi.com/?i=" . $imdbID . '&t=');
  $info=json_decode($json, true);
  $youtubeID = substr($_POST['youtube'],31,11);

  $date = $info['Released'];
  $ymd = DateTime::createFromFormat('d M Y', $date)->format('Y-m-d');
  $filename = strtolower(preg_replace("/[^\w]+/", "-", $info['Title'])) . ".jpg";
  
  $writers = explode(', ', $info['Writer']);
  $directors = explode(', ', $info['Director']);
  $genre = explode(', ', $info['Genre']);
  
  $sql="INSERT INTO itaproject.movies (MovieID, MovieName, ReleaseDate, IMDBId, IMDBRating, MPAA_Rating, Plot, YoutubeTrailer, ImageURL) VALUES ('" . $_POST['index'] . "', '". $info['Title']  . "', '" . $ymd . "', '" . $info['imdbID'] . "', '" . $info['imdbRating'] . "', '" . $info['Rated'] ."', " . '"' . $info['Plot'] . '"' . ", '" . $youtubeID . "', '" . $filename . "');"; 

  echo "-- " .  $info['Title'] . '<br>';
  echo $sql;
  echo '<br>';
  
  for($k=0; $k<count($writers); $k++){
    $sql_writers="INSERT INTO itaproject.movies_writers (MovieID, Writer) VALUES ('" . $_POST['index'] . "', '" . $writers[$k] . "');";
    echo $sql_writers;
    echo '<br>';
  }

  for($p=0; $p<count($directors); $p++){
    $sql_directors="INSERT INTO itaproject.movies_directors (MovieID, Directors) VALUES ('" . $_POST['index'] . "', '" . $directors[$p] . "');";
    echo $sql_directors;
    echo '<br>';
  }

  for($q=0; $q<count($genre); $q++){
    $sql_genre="INSERT INTO itaproject.movies_genre (MovieID, Genre) VALUES ('" . $_POST['index'] . "', '" . $genre[$q] . "');";
    echo $sql_genre;
    echo '<br>';
  }

  echo '<br><a href="' . $info['Poster'] . '" target="_blank"><input type="button" style="width: 100px; height: 35px;" value="View Image"></a>';

  echo '<input type="text" value="' . strtolower(preg_replace("/[^\w]+/", "-", $info['Title'])) . '">';
  //print_r($info);
  //echo $info['Title'];
}

?>

</div>
</body>
</html>