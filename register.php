<?php 
  require('inc/session.php');
  require("inc/db_connect.php");
?>

<?php
//include php files
include("inc/secure.php");

//variables set to empty values
$fnameE = $lnameE = $dobE = $addressE = $telE = $emailE = $conemailE = $usernameE = $passwordE = $conpasswordE = $genderE = "";
$fname = $lname = $dob = $address = $tel = $email = $conemail = $user = $username = $password = $conpassword = $propic = $gender = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(empty($_POST["firstName"])){
		$fnameE = " * First Name is required";
	}
	else{
		$fname = test_input($_POST["firstName"]);
		if(!preg_match("/^[a-zA-Z]*$/",$fname)){
			$fnameE = " * Only letters and white spaces allowed";
		}
	}
	if(empty($_POST["lastName"])){
		$lnameE = " * Last Name is required";
	}
	else{
		$lname = test_input($_POST["lastName"]);
		if(!preg_match("/^[a-zA-Z ]*$/",$lname)){
			$lnameE = " * Only letters and white spaces allowed";
		}
	}
	if(empty($_POST["dob"])){
		$dobE = " * Date of Birth is required";
	}
	else{
		$date = $_POST["dob"];
		$dob = date("Y-m-d", strtotime($date));
		}

	if(empty($_POST["address"])){
		$addressE = " * Address is required";
	}
	else{
		$address = test_input($_POST["address"]);
		if(!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9- ,()\/.]*$/',$address)){
			$addressE = " * Enter a valid address";
		}
	}
	if(empty($_POST["telephone"])){
		$telE = " * Telephone is required";
	}
	else{
		$tel = test_input($_POST["telephone"]);
		if(!preg_match("/^[0-9]*$/",$tel)){
			$telE = " * Enter a valid Telephone Number";
		}
	}
	if(empty($_POST["email"])){
		$emailE = " * E-mail is required";
	}
	else{
		$email = test_input($_POST["email"]);
		//$email = \"somebody@somesite.com\"; // Valid email address 
		// Set up regular expression strings to evaluate the value of email variable against
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
		// Run the preg_match() function on regex against the email address
		if (!preg_match($regex, $email)) {
			$emailE = " * Enter a valid E-mail address";
			}
	}
	if(empty($_POST["cemail"])){
		$conemailE = " * Confirm E-mail is required";
	}
	else{
		$conemail = $_POST["cemail"];
		if(!($conemail == $email))
			$conemailE = "E-mail does not match";
	}
	if(empty($_POST["username"])){
		$usernameE = " * Username is required";
	}
	else{
		$user = test_input($_POST["username"]);
		if(strlen($user>15 && $user<5))
			$usernameE = "Enter a username between 6 to 15";
		else
			$username = $user;
	}
	if(empty($_POST["password"])){
		$passwordE = " * Password is required";
	}
	else{
		$passwordstr = $_POST["password"];
		$pass = $passwordstr;
		if(strlen($pass>15 && $pass<8))
			$passwordE = "Enter a password between 8 to 15";
		else
			$password = md5($pass);
	}
	if(empty($_POST["cpassword"])){
		$conpasswordE = " * Confirm Password is required";
	}
	else{
		$conpassword = $_POST["cpassword"];
		if(!($pass == $conpassword))
			$conpasswordE = "Password does not match";
	}
	
	if(empty($_POST["gender"])){
		$genderE = " * Gender is required";
	}
	else{
		$gender = $_POST["gender"];
		}
	$datereg = date('Y/m/d H:i:s');
	//insert image ------
	
//sql_connect
if(null!=($fname) && null!=($lname) && null!=($dob) && null!=($gender) && null!=($address) && null!=($email) && null!=($conemail) && null!=($username) && null!=($password) && null!=($conpassword)){
	if(null==($fnameE) && null==($lnameE) && null==($dobE) && null==($addressE) && null==($telE) && null==($emailE) && null==($conemailE) && null==($usernameE) && null==($passwordE) && null==($conpasswordE) && null==($genderE))
	{
		$sql = "INSERT INTO members (First_Name, Last_Name, Username, Password, ProfilePicURL, DateOfBirth, Address, TelephoneNo, EmailAddress, DateRegistered, Gender)
		VALUES('$fname', '$lname', '$username', '$password', '$propic', '$dob', '$address', '$tel', '$email', '$datereg', '$gender')";
		if(!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));
		}	
header('Location: index.php');
	}
}
}

?>




<!DOCTYPE html>

<html lang="en">

<head>
	<title>Movie Hub</title>

	<link rel="stylesheet" type="text/css" href="css/main.css"/>
	<meta charset="utf-8">

	<script src="js/jquery-1.4.4.min.js" type="text/javascript"></script>

    <script src="js/jsCarousel-2.0.0.js" type="text/javascript"></script>

    <link href="css/jsCarousel-2.0.0.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
        $(document).ready(function() {
           $('#carouselhAuto').jsCarousel({ onthumbnailclick: function(src) { alert(src); }, autoscroll: true, masked: false, itemstodisplay: 9, orientation: 'h', autoscroll: true, circular: true });

        });       
        
    </script>
</head>

<body id="home">
<?php include('inc/header.php'); ?>



<section style="margin-top: 30px;">
<div class="content">

<h2 style="margin-bottom: 10px;">User Registration</h2>
<p id="require">* required field</p>
  <form class="registration" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
    <label for="firstName">First Name*</label><input type="text" name="firstName"><?php echo $fnameE;?></br>
    <label for="lastName">Last Name*</label><input type="text" name="lastName"><?php echo $lnameE;?></br>
    <label for="dob">Date of Birth*</label><input type="date" name="dob" ><?php echo $dobE;?></br>
	<label for="gender">Gender*</label><input type="radio" name="gender" value="M">Male
										<input type="radio" name="gender" value="F">Female<?php echo $genderE;?></br>
    <label for="address">Address*</label><input type="text" name="address"><?php echo $addressE;?></br>
    <label for="telephone">Telephone Number</label><input type="text" name="telephone"><?php echo $telE;?></br>
    <label for="email">E-mail</label><input type="text" name="email"><?php echo $emailE;?></br>
    <label for="cemail">Confirm E-mail</label><input type="text" name="cemail"><?php echo $conemailE;?></br>
    <label for="username">User Name</label><input type="text" name="username"><?php echo $usernameE;?></br>
    <label for="password">Password</label><input type="text" name="password"><?php echo $passwordE;?></br>
    <label for="cusername">Confirm Password</label><input type="text" name="cpassword"><?php echo $conpasswordE;?></br>
	<label for="image">Profile Picture</label><input type="file" name="image"></br>
	<input type="submit" id="submit" value="Submit">
</form>

</div>
</section>

<?php include('inc/footer.htm'); ?>

</body>
</html>