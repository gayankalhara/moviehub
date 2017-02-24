<?php
	session_start();
  	$userLoggedIn = false;
  	$userName = NULL;

  	if(isset($_SESSION['user']) && isset($_SESSION['password']))
  	{
		$userName = $_SESSION['user'];

		$userLoggedIn = true;
		

  	}
  ?>