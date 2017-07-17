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
    <div id="head-container" style="background-image:url(images/image_30.jpg);">
      <div class="head-title">FOOD</div>
    </div>

    <!-- content -->
    <div id="content">
      <table id="content-table">
        <tr class="verticalTop">
          <td width="30%">
            <div class="spaceTop">
              <div class="imageHover">
                <a href="food1.php"><img src="images/kaiseki_1.jpg" alt="kaiseki" class="content-image"></a>
                <span class="titleLeft">Kaiseki Ryori</span>
                <p class="textLeft">Kaiseki Ryori is a traditional multi-course Japanese dinner served in inns or ryokans in Japan. Though Kaiseki Ryori is not exclusive to Kyoto they are closely associated
                  with the area and is sometimes known as Kyo-Ryori or 京料理.</p>
              </div>
            </div>
          </td>
          <td width="30%">
            <div class="spaceTop">
              <div class="imageHover">
                <a href="food2.php"><img src="images/shojin_1.jpg" alt="shojin" class="content-image"></a>
                <span class="titleLeft">Shojin Ryori</span>
                <p class="textLeft">Shojin Ryori also known as Buddhist cuisine is served at many temples in Kyoto and consists of purely vegetarian dishes. Shojin Ryori is created with simple preparation with extremely high standards
                  for the food’s quality, wholesomeness, and flavor.</p>
              </div>
            </div>
          </td>
          <td width="30%">
            <div class="spaceTop">
              <div class="imageHover">
                <a href="food3.php"><img src="images/wagashi_1.jpg" alt="wagashi" class="content-image"></a>
                <span class="titleLeft">Wagashi</span>
                <p class="textLeft">Wagashi are traditional japanese deserts made of mochi, bean paste, or fruits. Typically, they are made from plant ingredients and are usually served with tea.
                  Wagashi comes in various designs and makes great souvenirs for tourists!</p>
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
