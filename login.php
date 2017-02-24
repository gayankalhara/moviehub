<?php
session_start();
require("inc/db_connect.php");
$error = "";
if(isset($_POST['username'])&&isset($_POST['password']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(!empty($username)&&!empty($password))
	{
		$password_hash = md5($password);
		$query = "SELECT UserName, Password, First_Name from members
					where UserName = '$username' AND Password = '$password_hash'";
					
		$query_run = mysqli_query($con, $query);
		$rows = mysqli_fetch_array($query_run);
		$error = $rows["First_Name"];
		if($query_run = mysqli_query($con, $query))
		{
			$rows = mysqli_fetch_array($query_run);
			$error = $rows["First_Name"];
			if($rows == 0)
			{
				$error = "Invalid username/password combination! Please try again!";
			}
			else
			{
				$_SESSION['user'] = $username;
				$_SESSION['password'] = $password_hash;
				$_SESSION['name'] = $rows["First_Name"];
				header('Location: index.php');
			}
		}
	}
	else
	{
		$error = "Enter a username and password!";
	}
}
mysqli_close($con);
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
	<title>Movie Hub</title>

	<link rel="stylesheet" type="text/css" href="css/main.css"/>
	<link rel="icon" type="image/png" href="img/favicon.png" />

  <style>
    .error{
      display: block;
      background-color: #e20808;
      padding: 7px;
      text-align: center;
      color: #fff;
      border-radius: 6px;
    }

    #login2{
      margin-top: 30px;
      width: 60%;
      margin-left: auto;
      margin-right: auto;
    }

    input[type=submit]{
      padding-left: 60px;
      padding-right: 60px;
      padding-top: 10px;
      padding-bottom: 10px;
    }

    input[type=text], input[type=password]{
      width: 90%;
      padding: 5px 10px 5px 10px;
      height: 25px;
      margin-bottom: 10px;
      border-radius: 8px;
      background: url(img/text-bg.jpg);
      border: 0px solid #fff;
    }

    hr{
      border: 0;
      height: 2px;
      background-color: #222;
      margin-bottom: 15px;
      margin-top: 15px;
  }
  </style>
</head>

<body>

<?php include('inc/header.php'); ?>

<?php 

      echo '<div class="content text-center">';
      echo '<div style="width: 700px; height: 100%; background-color: rgba(0,0,0,0.5); margin-top: 55px; margin-left: auto; margin-right: auto; border-radius: 20px; padding: 25px;" >';

      if($error != ""){
        echo '<div class="error">' . $error . '</div>';
      }

      ?>

    <div id="login2">
    <form name="login" method="POST" action="login.php">
             <input type="text" name="username" placeholder="User Name" /><br>
             <input type="password" name="password" placeholder="Password" /><br>
             <input type="submit" value="Login" class="blue-button">
    </form>
    <hr>
      <h4>Not Registered Now?</h4>
      <a href="signup.php" style="">Sign Up Now</a>

    </div>
    </div>
    </div>

<?php include('inc/footer.htm'); ?>
</body>
</html>