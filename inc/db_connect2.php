<?php
	// Create connection 
	$con = mysqli_connect("itaproject2.db.11555734.hostedresource.com" , "itaproject2" , "cPMth6T4Q!" , "itaproject2");	

	// Check connection
	if(mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

?>