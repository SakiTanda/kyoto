<?php 
  session_start();
  header('X-Frame-Options: DENY');

  $loginflag = false;

  //Get the POST values
  $name = $_SESSION['Username'];
  
  if (!empty($name)) {
    $loginflag = true;
  }
?>

<!doctype html>
<html lang="en">

  <!-- Head section -->
  <head>
    <title>Kyoto</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/skippr.css">
    <link rel="stylesheet" href="css/base.css">
  </head>

  <!-- Body section -->
  <body>
    <!-- Navi -->
    <nav id="navbar">
      <a href="index.php" id="nav-logo">Kyoto</a>
      <div id="nav-sub-logo">where Japanese culture is evolving</div>
      <!-- login start -->
      <?php if ($loginflag) { ?>
        <a href="logout.php" id="nav-logout">LOGOUT</a>
        <div id="nav-username"><?php echo substr($name, 0, 1); ?></div>
      <?php } else { ?>
        <a href="login.php" id="nav-login">LOGIN</a>
      <?php } ?>
      <!-- login end -->
      <ul>
        <li><a href="events.php" class="buttonHover">EVENTS</a></li>
        <li><a href="food.php" class="buttonHover">FOOD</a></li>
        <li><a href="sights.php" class="buttonHover">SIGHTS</a></li>
      </ul>
    </nav>

    <!-- header -->
    <div id="container">
      <div id="theTarget">
        <div style="background-image:url(images/image_15.jpg)"><div class="head-title">Kyoto</div></div>
        <div style="background-image:url(images/image_27.jpg)"><div class="head-title">Kyoto</div></div>
        <div style="background-image:url(images/image_40.jpg)"><div class="head-title">Kyoto</div></div>
      </div>
    </div>

    <!-- content -->
    <div id="content">
      <table id="content-table">
        <tr>
          <td colspan="3">
            <p class="titleCenter">
              Kyoto a city with Vibrant Life and Color.
            </p>
          </td>
        </tr>
        <tr class="verticalTop">
          <td width="30%">
            <div class="imageHover">
              <a href="events.php"><img src="images/image_12.jpg" alt="Events" class="content-image"></a>
              <span class="titleLeft">Events</span>
              <p class="textLeft">There are several upcoming events May to July.Each festival has different features, attending them must be fun. Especially, on July, Japan's most famous festival Gion Matsuri is taken place in down town Kyoto. Other festivals are famous as well. Please check it out.</p>
            </div>
          </td>
          <td width="30%">
            <div class="imageHover">
              <a href="food.php"><img src="images/kaiseki_2.jpg" alt="Food" class="content-image"></a>
              <span class="titleLeft">Food</span>
              <p class="textLeft">Food is a large part of Kyoto’s traditions and culture. Not only are they made with vast amounts of thought and effort they also must be presented carefully to enhance their appearance. Traditional foods in Kyoto are made with seasonal, local ingredients and directly represent the city’s people and culture.</p>
            </div>
          </td>
          <td width="30%">
            <div class="imageHover">
              <a href="sights.php"><img src="images/image_11.jpg" alt="Sights" class="content-image"></a>
              <span class="titleLeft">Sights</span>
              <p class="textLeft">Kyoto is a beautiful city that has kept its culture and history alive since the period it was known as the imperial capital of Japan. The city is culturally renowned for its ancient temples and shrines. The ancient sights highly captivate the historic nature of Buddhist culture that once thrived throughout Kyoto.</p>
            </div>
          </td>
        </tr>
      </table>
    </div>

    <!-- footer -->
    <div class="spaceTopForFooter"></div>
    <div id="footer">
      <a href="about.php" id="footer-about">About</a>
      <p>Portfolio website developed by php, html, etc. in 2017</p>
    </div>

    <!-- javascript -->
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/skippr.js"></script>
    
    </body>
</html>
