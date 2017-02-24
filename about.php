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
    nav li#about
    {
      background-color: #000;
    }

    table.images td
    {
      vertical-align:top; text-align:justify; padding: 25px !important;
    }

    p
    {
      font-size: 18px;
      text-align:justify;
      color: #fff;
      line-height: 25px;
      margin-bottom: 20px;
      font-weight: 100;
    }
  </style>
</head>

<body>

<?php include('inc/header.php'); ?>

<div class="content" style="margin-top: 30px;">
<h1>About Us</h1>
<br/>
<ol>
  <li><h3>Introduction</h3></li><br/>
    <p><b style="color:red;">"Movie Hub"</b>, the goal of this project is to develop a computer based system for renting movies online.  We use the latest HTML5 and CSS3 technologies along with JavaScript to design and develop the User Interface of this site. PHP will be used as the server side programming language and MySQL will be used as the Database Management System. This is a project with the objective to develop a basic e-Commerce website where a consumer is provided with a shopping cart application.</p> 

    <p>This system will act as a basic online store. An online store is a virtual store on the Internet where customers can browse the catalog and select products of interest. The selected items may be collected in a shopping cart. At checkout time, the items in the shopping cart will be presented as an order. At that time, more information will be needed to complete the transaction. Usually, the customer will be asked to fill or select contact details, a shipping address and payment information such as credit card number etc. An e- mail notification is sent to the customer as soon as the order is placed.</p>

    <br/><br/>

  <li><h3>Objective</h3></li><br/>
    <p>The objective of this project is to develop a general purpose e-commerce online movie rental system where movies can be rented from the comfort of home through the Internet. A CD/DVD copy of the movie will be delivered within specified period of time to the address provided by the customer via local delivery methods. Or else the customer can watch the movie instantly without any waiting time. (Internet charges will apply for data usage and no shipping charges). We recommend latest and popular movies for our customers which will lead to increase our sales.</li>

      <br/><br/><br/>

  <li><h3>Members</h3></li><br/>
    <table class="images">

      <tr>
      <td><img src="img/about/gayan.png" width="130px" height="130px"></td>
      <td><h4><br/>Gayan<br/>IT14062148</h4></td>
      <td><img src="img/about/hasitha.png" width="130px" height="130px"></td>
      <td><h4><br/>Hasitha<br/>IT14079146</h4></td>
      <td><img src="img/about/udesh.png" width="130px" height="130px"></td>
      <td><h4><br/>Udesh<br/>IT14048838</h4></td>
      </tr>

      <tr>
      <td><img src="img/about/budhdhika.png" width="130px" height="130px"></td>
      <td><h4><br/>Budhdhika<br/>IT14015472</h4></td>
      <td><img src="img/about/kia.png" width="130px" height="130px"></td>
      <td><h4><br/>Dhanushka<br/>IT14034350</td></td>
      <td><img src="img/about/milantha.png" width="130px" height="130px"></td>
      <td><h4><br/>Milantha<br/>IT14048456</h4></td>
      </tr>

      <tr>
      
      </tr>

      <tr>
      <td><img src="img/about/sehan.png" width="130px" height="130px"></td>
      <td><h4><br/>Sehan<br/>IT14048906</h4></td>
      <td><img src="img/about/kalif.png" width="130px" height="130px"></td>
      <td><h4><br/>Kalif<br/>IT14047466</h4></td>
      </tr>

    </table>

</ol>
</div>

<?php include('inc/footer.htm'); ?>
</body>
</html>