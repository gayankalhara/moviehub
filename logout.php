<?php
session_start();
?>

<?php
	if(isset($_SESSION['username'])){
		session_unset();
		
		}


	if(isset($_GET['ref'])){
		header("Location: " . $_GET['ref'] . ".php");
	}
	else{
		header("Location: index.php");
	}

session_destroy();
?>
