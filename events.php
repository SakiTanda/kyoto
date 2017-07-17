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
    <div id="head-container" style="background-image:url(images/events.jpg);">
      <div class="head-title">EVENTS</div>
    </div>

    <!-- content -->
    <div id="content">
      <table id="content-table">
        <tr class="verticalTop">
          <td width="30%">
            <div class="spaceTop">
              <div class="imageHover">
                <a href="event1.php"><img src="images/event1_01.jpg" alt="kaiseki" class="content-image"></a>
                <span class="titleLeft">Aoi Festival</span>
                <p class="textLeft">This is the one of Kyoto’s 3 major annual events in May. It dates back to the sixth century.</p>
              </div>
            </div>
          </td>
          <td width="30%">
            <div class="spaceTop">
              <div class="imageHover">
                <a href="event2.php"><img src="images/event2_01.jpg" alt="shojin" class="content-image"></a>
                <span class="titleLeft">Kifune Festival</span>
                <p class="textLeft">The most important festival for Japan's one of famouse Kifune Shrine in June.</p>
              </div>
            </div>
          </td>
          <td width="30%">
            <div class="spaceTop">
              <div class="imageHover">
                <a href="event3.php"><img src="images/event3_01.jpg" alt="wagashi" class="content-image"></a>
                <span class="titleLeft">Gion Festival</span>
                <p class="textLeft">Japan's most famouse festival which is taken place in down town Kyoto in July.</p>
              </div>
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

  </body>

</html>
