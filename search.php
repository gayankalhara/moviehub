<?php 
  require('inc/session.php');
  require("inc/db_connect.php");
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
	<title>Movie Hub</title>

	<link rel="stylesheet" type="text/css" href="css/main.css"/>
	<link rel="icon" type="image/png" href="img/favicon.png" />
	
	<style>
		 table td
		 {
		 	vertical-align:top; text-align:justify; padding: 25px !important;
		 }

		 ul
		 {
			style-type:none;
		 }


	</style>

</head>

<body>

<?php include('inc/header.php'); ?>

<div class="content" style="margin-top:35px;">
<?php 

	if(isset($_GET['method']) && $_GET['method']=="NS"){

	$noResults = false;
	$hasSet = false;
	if(isset($_GET['query']) && $_GET['query']!=""){
		$query = $_GET['query'];
		$hasSet = true;
	}
	else{
		$query = "";
		$hasSet = false;
	}

	$result=mysqli_query($con,"Select * from movies where MovieName LIKE '%" . $query . "%' and Approved=0") or die(mysql_error());
	$count_query="SELECT COUNT(MovieID) AS 'MovieCount' FROM movies WHERE MovieName LIKE '%" . $query . "%' and Approved=0";
	
	$result1=mysqli_query($con, $count_query) or die(mysql_error());
	
	while($movie1=mysqli_fetch_array($result1))
	{
		if($movie1['MovieCount']==0 || $query == ""){
			$noResults==true;
			echo "<h1>No Result Found</h1>";
		}
		else
			echo "<b><h3>".$movie1['MovieCount'] . " matches found.</h3></b>";
	}

	$count=1;

	if($noResults == false && $query != ""){
		echo "<table>"; 
			while($movie=mysqli_fetch_array($result))
			{
			$query = "INSERT INTO Search_Info (movie_id, film_name) VALUES ('" . $movie["MovieID"] . "', '" . $movie["MovieName"] . "');";
			mysqli_query($con, $query);
				
			echo "<tr>";
				
				echo "<td>";
					echo "<b><h4>".$count.".</h4></b>";	
				echo "</td>";

				echo "<td>";
					echo '<a href="movie.php?id=' . $movie["MovieID"] . '"><img style="border:2px solid blue; border-radius:12px;" src="img/movies/' . $movie['ImageURL'] . '" width="100px" height="148px"></a>';
				echo "</td>";
				
				echo "<td>";
					echo "<ul>";
						echo "<li><strong><h4>".$movie["MovieName"]."</h4></strong></li><br/>";
						echo "<li>Year : ".$movie["ReleaseDate"]."</li><br/>";
						echo '<li>Ratings : <img src="img/rating.png"></li>';
					echo "</ul>";
				echo "</td>";

				echo '<td width="250px">';
					echo "<h5>".$movie['Plot']."</h5>";
				echo "</td>";

				echo '<td><br/><br/><input style="margin-bottom: 5px;" type="button" class="blue-button" value="Add to Cart"><br><input type="button" class="blue-button" value="View Details"></td>';	

			echo "</tr>";  
			$count++;
			}
		echo "</table>";

	}
	
}

else if(isset($_GET['method']) && $_GET['method']=="AS")
{

	$name = $_GET['name'];
	$additionals = "";
	$orderby = "";
	$arrayGenre = array();

	$action = $animation = $children = $comedy = $drama = $horror = $scifi = $orderByName = 0;

		if(isset($_GET['Action']))
		$action = 1;
           
        if(isset($_GET['Animation']))
        $animation =1; 
  
        if(isset($_GET['Children']))
        $children =1;
      
        if(isset($_GET['Comedy']))
        $comedy =1;

        if(isset($_GET['Drama']))
        $drama =1;

        if(isset($_GET['Horror']))
        $horror =1;

        if(isset($_GET['SciFi']))
        $scifi = 1;

    	if(isset($_GET['from']))
        $from = $_GET['from'];

    	if(isset($_GET['to']))
        $to = $_GET['to'];

    	if(isset($_GET['orderByName']))
        $orderByName = $_GET['orderByName'];

		if($name!=""){
		$additionals .= " AND MovieName LIKE '%" . $name . "%'" ;
		}

		if($action==1){
		array_push($arrayGenre,"'Action'");
		}

		if($animation==1){
		array_push($arrayGenre,"'Animation'");
		}

		if($children==1){
		array_push($arrayGenre,"'Children'");
		}

		if($comedy==1){
		array_push($arrayGenre,"'Comedy'");
		}

		if($drama==1){
		array_push($arrayGenre,"'Drama'");
		}

		if($horror==1){
		array_push($arrayGenre,"'Horror'");
		}

		if($scifi==1){
		array_push($arrayGenre,"'SciFi'");
		}

		$genre_add = implode(",", $arrayGenre);

		if($action==1 || $animation==1 || $children==1 || $comedy==1 || $drama==1 || $horror==1 || $scifi==1 ){
		$additionals .= " AND Genre IN(" . $genre_add . ")" ;
		}

		if($from!=""){
		$additionals .= " AND YEAR(ReleaseDate)>=" . $from;
		}

		if($to!=""){
		$additionals .= " AND YEAR(ReleaseDate)<=" . $to;
		}

		if($orderByName==1){
		$orderby .= " ORDER BY MovieName " . $_GET['nameOrder'];
		}

	$sql_string = "SELECT DISTINCT m.MovieID, MovieName, ReleaseDate, IMDBRating, Plot, ImageURL, Approved, View_Count " .
				 "FROM movies m, movies_genre mg WHERE m.MovieID = mg.MovieID " . $additionals . " " . $orderby . " LIMIT 0, " . $_GET['limit'] .";";

	$count_query="SELECT  COUNT(DISTINCT m.MovieID) AS 'MovieCount'" .
				 "FROM movies m, movies_genre mg WHERE m.MovieID = mg.MovieID " . $additionals . " " . $orderby . " LIMIT 0, " . $_GET['limit'] .";";
	
				// echo $sql_string;

	$result1=mysqli_query($con, $count_query) or die(mysql_error());
		while($movie1=mysqli_fetch_array($result1))
		{
			if($movie1['MovieCount']==0){
			echo "<h1>No Result Found</h1>";
			}
			else
			echo "<b><h3>".$movie1['MovieCount'] . " matches found.</h3></b>";
		}


	$result=mysqli_query($con,$sql_string);
	$count=1;

	echo "<table>"; 
			while($movie=mysqli_fetch_array($result))
			{
			$query = "INSERT INTO Search_Info (movie_id, film_name) VALUES ('" . $movie["MovieID"] . "', '" . $movie["MovieName"] . "');";
			mysqli_query($con, $query);
			
			echo "<tr>";
				
				echo "<td>";
					echo "<b><h4>".$count.".</h4></b>";	
				echo "</td>";

				echo "<td>";
					echo '<a href="movie.php?id=' . $movie["MovieID"] . '"><img style="border:2px solid blue; border-radius:12px;" src="img/movies/' . $movie['ImageURL'] . '" width="100px" height="148px"></a>';
				echo "</td>";
				
				echo "<td>";
					echo "<ul>";
						echo "<li><strong><h4>".$movie["MovieName"]."</h4></strong></li><br/>";
						echo "<li>Year : ".$movie["ReleaseDate"]."</li><br/>";
						echo '<li>Ratings : <img src="img/rating.png"></li>';
					echo "</ul>";
				echo "</td>";

				echo '<td width="250px">';
					echo "<h5>".$movie['Plot']."</h5>";
				echo "</td>";

				echo '<td><br/><br/><input style="margin-bottom: 5px;" type="button" class="blue-button" value="Add to Cart"><br><input type="button" class="blue-button" value="View Details"></td>';	

			echo "</tr>";  
			$count++;
			}
		echo "</table>";

}
?>


</div>

<?php include('inc/footer.htm'); ?>
</body>
</html>