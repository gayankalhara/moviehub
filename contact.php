<?php 
  require('inc/session.php');
  require("inc/db_connect.php");
?>

<!-- 
=================================================
 											                           
 		ITA Group Project						                 	
 		Copyright (c) 2014. SLIIT. 				           
 		All Rights Reserved. 					               
 												                         
 		Team Members: 							                 
 			(*) Gayan Kalhara					                 
 			(*) Hasitha Jayasinghe				             
 			(*) Udesh Hewagama					               
 			(*) Sehan Dananjaya					               
 			(*) Dhanushka Udayanga				             
 			(*) Kalif Rahim						                 
 			(*) Buddhika Prasanna				               
 			(*) Milantha Ekanayake				             
 												                         
=================================================
                                              -->
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
	<title>Movie Hub</title>

	<link rel="stylesheet" type="text/css" href="css/main.css"/>
	<link rel="icon" type="image/png" href="img/favicon.png" />

  <style>
    nav li#contact{
      background-color: #000;
    }

    .form-contact-us {
  position: relative;
  top: 100px;
  left: 250px;
  height: 600px;
}

.form-contact-us input[type="text"]{
  border-radius: 10px;
  width: 500px;
  height: 40px;
  padding: 5px 15px 5px 15px;
  background: url(img/text-bg.jpg);
  background-size: 20px 50px;
  font-size: 18px;
  border: 1px solid #fff;
  vertical-align: bottom;
  text-decoration:none;
}

.form-contact-us input[type="email"]{
  border-radius: 10px;
  width: 500px;
  height: 30px;
  padding: 5px 15px 5px 15px;
  background: url(img/text-bg.jpg);
  background-size: 20px 50px;
  font-size: 18px;
  border: 1px solid #fff;
  vertical-align: bottom;
}

.form-contact-us input[type="password"]{
  border-radius: 10px;
  width: 500px;
  height: 30px;
  padding: 5px 15px 5px 15px;
  background: url(img/text-bg.jpg);
  background-size: 20px 50px;
  font-size: 18px;
  border: 1px solid #fff;
  vertical-align: bottom;
}

.form-contact-us textarea{
  border-radius: 10px;
  width: 500px;
  height: 200px;
  padding: 5px 15px 5px 15px;
  background: url(img/text-bg.jpg);
  background-size: 20px 250px;
  font-size: 18px;
  border: 1px solid #fff;
  vertical-align: bottom;
  

}
  </style>
</head>

<body>

<?php include('inc/header.php');?>

<div class="content" style="margin-top: 30px;">
<h2>Contact Us</h2>

<div class="form-contact-us">
      <form name="contact" method="post" action="validate-contact-us.php">
        <label> 
          <h3 style="margin-bottom:5px;">
            Name
          </h3> 
        </label>        
          <input style="height: 30px" type="text" id="name" name="name" />  
          
        <label> 
          <h3 style="margin-bottom:5px;"> <br />
            Email
          </h3>         
        </label>
          <input type="email" id="email" name="email"/> 
          
        <label> 
          <h3 style="margin-bottom:5px;"> <br />
            Comments
          </h3>         
        </label>
          <textarea id="comments" name="comments" > </textarea>
          <br/><br/><br/>
          <input type="submit" id="submit" value="Submit" class="blue-button" />
      </form>
    </div>
</div>

<?php include('inc/footer.htm'); ?>
</body>
</html>