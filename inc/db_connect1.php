<?php
	// Create connection 
	$con = mysqli_connect("itaproject.db.11555734.hostedresource.com" , "itaproject" , "cPMth6T4Q!" , "itaproject");	

	// Check connection
	if(mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

?>