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
    <div id="head-container" style="background-image:url(images/image_20.jpg);">
      <div class="head-title">SIGHTS</div>
    </div>

    <!-- content -->
    <div id="content">
      <table id="content-table">
        <tr class="verticalTop">
          <td width="30%">
            <div class="spaceTop">
              <div class="imageHover">
                <a href="sight1.php"><img src="images/nijo.jpg" alt="Nijo Castle" class="content-image"></a>
                <span class="titleLeft">Nijo Castle</span>
                <p class="textLeft">A historic castle that was build in 1603 during the Edo Period. Guest will be able to see and explore the castle that was once used as the imperial palace of Japan. The palace can be argued as one of the best-preserved examples of Japanese castle architecture and craftsmanship of the Japanese feudal era.</p>
              </div>
            </div>
          </td>
          <td width="30%">
            <div class="spaceTop">
              <div class="imageHover">
                <a href="sight2.php"><img src="images/kiyomizu.jpg" alt="kiyomizu" class="content-image"></a>
                <span class="titleLeft">kiyomizu Temple</span>
                <p class="textLeft">The eastern Japanese temple Kiyomizudera, also known as the “Pure Water Temple”, is a popular temple residing in Kyoto that gets its name from the clean and pure water that runs off the Otowa Waterfall. Visitors of the Kiyomizudera Temple will be able to explore the temple and the many attractions on it’s grounds including the Jishu Shrine and Otowa Waterfall.</p>
              </div>
            </div>
          </td>
          <td width="30%">
            <div class="spaceTop">
              <div class="imageHover">
                <a href="sight3.php"><img src="images/inari.jpg" alt="inari" class="content-image"></a>
                <span class="titleLeft">Fushimi Inari Shrine</span>
                <p class="textLeft">A famous Shinto shrine that is renowned for it’s thousands of torri gates which trail off from the main building. Visitors will be able to explore the shrine and follow the gates to the wooded forest of the sacred Mount Inari.</p>
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
