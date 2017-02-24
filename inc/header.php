<?php require_once("inc/db_connect.php"); ?>

<!-- #BEGIN : Header -->
<header id="header-wrap">
  <div id="header">
      <!-- #BEGIN : Logo -->
      <div id="logo">
            <a href="index.php"><img alt="Movie Hub Logo" src="img/logo.png"/></a>
      </div>
      <!-- #END : Logo -->

      <!-- #BEGIN : Main Menu -->
      <nav>
          <ul>
              <li id="home">
                <a class="menu" href="index.php">Home</a>
              </li>

              <li id="about">
                <a class="menu" href="about.php">About</a>
              </li>

              <li>
                <a class="menu" href="search.php?name=&from=&to=&nameOrder=ASC&limit=10&method=AS">Movies</a>
                <ul>
                    <li><a class="sub-menu" href="search.php?name=&Action=1&from=&to=&nameOrder=ASC&limit=10&method=AS">Action</a></li>
                    <li><a class="sub-menu" href="search.php?name=&Animation=1&from=&to=&nameOrder=ASC&limit=10&method=AS">Animation</a></li>
                    <li><a class="sub-menu" href="search.php?name=&Children=1&from=&to=&nameOrder=ASC&limit=10&method=AS">Children</a></li>
                    <li><a class="sub-menu" href="search.php?name=&Comedy=1&from=&to=&nameOrder=ASC&limit=10&method=AS">Comedy</a></li>
                    <li><a class="sub-menu" href="search.php?name=&Drama=1&from=&to=&nameOrder=ASC&limit=10&method=AS">Drama</a></li>
                    <li><a class="sub-menu" href="search.php?name=&Horror=1&from=&to=&nameOrder=ASC&limit=10&method=AS">Horror</a></li>
                    <li><a class="sub-menu" href="search.php?name=&SciFi=1&from=&to=&nameOrder=ASC&limit=10&method=AS">Sci-Fi</a></li>
                </ul>
              </li>


        <li id="forum">
                <a class="menu" href="forum.php">Forum</a>
              </li> 

              <li id="contact">
                <a class="menu" href="contact.php">Contact</a>
              </li> 

              <li id="cart-menu">
                <img alt="cart" src="img/cart.png">
                <a class="menu" href="cart.htm" style="padding-left: 5px;">0 items</a>
                <div id="cart">
                  <table>
                    <tr>
                      <td class="film-name"><img alt="Remove" class="remove" src="img/remove.png">How to Train Your Dragon 2</td>
                      <td class="film-price">LKR 2,300.00</td>
                    </tr>
                    <tr>
                      <td class="film-name"><img alt="Remove" class="remove" src="img/remove.png">Tare Zameen Par</td>
                      <td class="film-price">LKR 2,300.00</td>
                    </tr>
                    <tr>
                      <td class="film-name"><img alt="Remove" class="remove" src="img/remove.png">The Internship</td>
                      <td class="film-price">LKR 2,300.00</td>
                    </tr>
                    <tr>
                      <td class="film-name"><img alt="Remove" class="remove" src="img/remove.png">3-Idiots</td>
                      <td class="film-price">LKR 2,300.00</td>
                    </tr>
                    <tr>
                      <td class="film-name"><img alt="Remove" class="remove" src="img/remove.png">Mission: Impossible Ghost Protocol</td>
                      <td class="film-price">LKR 2,300.00</td>
                    </tr>
                    <tr>
                      <td class="total">Total&nbsp;&nbsp;</td>
                      <td class="total-price">LKR 9,200.00</td>
                    </tr>
                            </table>
                            <div class="text-center"><input type="button" class="blue-button" value="Empty Cart">&nbsp;&nbsp;<input type="button" class="blue-button" value="Checkout"></div>
                          </div>
              </li> 

                <li id="user-menu">
                <img class="icon" style="padding-top: 27px; padding-bottom: 26px;"; alt="user" src="img/user.png">
                
                <div id="user">
                      <?php

                        if($userLoggedIn == true){

                        $query = "select First_Name, ProfilePicURL from members WHERE UserName='" . $userName . "';";
                        $query_con = mysqli_query($con,$query);
                        $topic=mysqli_fetch_array($query_con) or die(mysql_error());
                      ?>

                      <h3 style="font-size: 23px; margin-top:6px; margin-bottom:8px;">Howdy <?php echo $topic["First_Name"]; ?>?</h3>
                        <img style="border: 2px solid #434343; border-radius: 15px;" src="img/users/<?php echo $topic["ProfilePicURL"];?>">
                        <div style="display: inline-block; vertical-align: top; margin-top: 10px;">
                            <a href="my-account.php"><input style="width: 130px; height: 32px; margin-bottom: 3px;" type="button" class="blue-button" value="My Account"></a><br>
                            <a href="logout.php?ref=<?php echo preg_replace('/\.[^.]+$/','',basename($_SERVER['PHP_SELF'])); ?>"><input style="width: 130px; height: 32px;" type="button" class="blue-button" value="Logout"></a>
                        </div>
                      <?php }
                      else{

                       ?>
                      
                       <div id="login2">
    <h4 style="margin-bottom:5px;">User Login</h4>
    <form name="login" method="POST" action="login.php">
             <input type="text" name="username" placeholder="User Name" /><br>
             <input type="password" name="password" placeholder="Password" /><br>
             <input type="submit" value="Login" class="blue-button">
             <a href="register.php" style="margin-top: 6px; margin-bottom: 0px; padding-bottom: 0px; margin-left: 9px;">Register</a>
    </form>
  </div>

                      <?php } ?>
                </div>

                
              </li> 
              
          </ul>
      </nav>
      <!-- #END : Main Menu -->

  </div>
</header>
<!-- #END : Header -->