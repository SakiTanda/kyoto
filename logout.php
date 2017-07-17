<?php 
  session_start();  
  session_destroy();
  header('X-Frame-Options: DENY');
?>

<!doctype html>
<html lang="en">

  <!-- Head section -->
  <head>
    <title>Kyoto</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/form.css">
  </head>

  <!-- Body section -->
  <body>
  
    <!-- Navi -->
    <nav id="navbar">
      <a href="index.php" id="nav-logo">Kyoto</a>
      <div id="nav-sub-logo">where Japanese culture is evolving</div>
      <a href="login.php" id="nav-login">LOGIN</a>
      <ul>
        <li><a href="events.php" class="buttonHover">EVENTS</a></li>
        <li><a href="food.php" class="buttonHover">FOOD</a></li>
        <li><a href="sights.php" class="buttonHover">SIGHTS</a></li>
      </ul>
    </nav>
        
    <!-- content -->
    <div id="form-content">      
      <!-- headding -->
      <h1 id="form-content_title">Logout</h1>
      <p>You have already logged out.</p>      
    </div>
    
    <!-- footer -->
    <div id="footer">
      <a href="about.php" id="footer-about">About</a>
      <p>Portfolio website developed by php, html, etc. in 2017</p>
    </div>
    
  </body>

</html>