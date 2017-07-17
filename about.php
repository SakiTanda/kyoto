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
    <div id="head-container" style="background-image:url(images/image_44.jpg);">
      <div class="head-title">About</div>
    </div>
    
    <!-- content -->
    <div id="content">
      <table id="content-table">
        <tr class="verticalTop">
          <td width="100%">
            <div class="spaceTop">
              <p class="textBigCenter">Who I Am</p>
              <p class="textLeft">I am a software engineer. Please look at my <a href="https://www.linkedin.com/in/saki-tanda-26b0b8141/">linkedin</a>. Also, I developed <a href="https://obscure-mesa-98847.herokuapp.com/">an another portfolio website</a> which created by Ruby on Rails. The source files of the website by created ruby on rails are shown to my <a href="https://github.com/SakiTanda/freshness">github</a>. If you have any questions or concerns feel free to contact me. Email: sakitsukuda@gmail.com.</p>
            </div>
          </td>
        </tr>
        <tr>
          <td width="100%">
            <p class="textBigCenter">What the website is</p>
            <p class="textLeft">This website is my portfolio website which created by PHP, html, css, javascript and MySQL. This website was created for expanding people’s knowledge and interest for the fascinating city of Kyoto. Its goal is to help promote and encourage tourism throughout the city of Kyoto and to provide visitors with explicit information regarding the many cultural events, sights and foods that can be experienced in Kyoto. The site is orientated towards anyone who is fond of travelling or carries a general interest in Japan. I hope that after navigating throughout our site you will have a better understanding of Kyoto’s beauty and will have the necessary information to make sound travel plans.      
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
