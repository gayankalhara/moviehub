<?php require_once("../inc/db_connect.php"); ?>

<!-- #BEGIN : Header -->
<header id="header-wrap">
  <div id="header">
      <!-- #BEGIN : Logo -->
      <div id="logo">
            <a href="../index.php"><img alt="Movie Hub Logo" src="../img/logo.png"/></a>
      </div>
      <!-- #END : Logo -->

      <!-- #BEGIN : Main Menu -->
      <nav>
          <ul>
              <li id="home">
                <a class="menu" href="index.php">Home</a>
              </li>

              <li id="movies">
                <a class="menu" href="movies.php">Movies</a>
              </li>

              <li id="comments">
                <a class="menu" href="comments.php">Comments</a>
              </li>

              <li id="faq">
                <a class="menu" href="">FAQ</a>
              </li>

              <li id="forum">
                <a class="menu" href="forum.php">Forum</a>
              </li> 


            
                <?php 

                if($userLoggedIn == true){ ?>

                <li id="user-menu">
                <img class="icon" style="padding-top: 27px; padding-bottom: 26px;"; alt="user" src="img/user.png">
                
                
                <div id="user">
                  

    <?php
      $query = "select First_Name, ProfilePicURL from members WHERE UserName='" . $_SESSION['user'] . "';";
      $query_con = mysqli_query($con,$query);
      $topic=mysqli_fetch_array($query_con) or die(mysql_error());


    ?>

    <h3 style="font-size: 23px; margin-top:6px; margin-bottom:8px;">Howdy <?php echo $topic["First_Name"]; ?>?</h3>
      <img style="border: 2px solid #434343; border-radius: 15px;" src="img/users/<?php echo $topic["ProfilePicURL"];?>">
      <div style="display: inline-block; vertical-align: top; margin-top: 10px;">
      <a href="my-account.php"><input style="width: 130px; height: 32px; margin-bottom: 3px;" type="button" class="blue-button" value="My Account"></a><br>
      <a href="logout.php?ref=<?php basename($_SERVER['PHP_SELF']); ?>"><input style="width: 130px; height: 32px;" type="button" class="blue-button" value="Logout"></a>
      </div>

                </div>

                
              </li> 
              <?php } ?>
          </ul>
      </nav>
      <!-- #END : Main Menu -->

  </div>
</header>
<!-- #END : Header -->