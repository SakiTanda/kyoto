<?php
  session_start();
  header('X-Frame-Options: DENY');

  // error flag of user
  $userErrFlag = false;
  
  if (!empty($_POST['Username']) && !empty($_POST['E-mail']) && !empty($_POST['Password'])) {

    // include database connection details
    require_once('config.php');

    // connect to mysql server
    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE);
    if($conn->connect_error) {
      echo('Failed to connect to server: ' . $conn->connect_error);
      exit;
    }

    // get the POST values & escape strings 
    $name = mysqli_real_escape_string($conn, trim($_POST['Username']));
    $mail = mysqli_real_escape_string($conn, trim($_POST['E-mail']));
    $password = password_hash(trim($_POST['Password']), PASSWORD_DEFAULT);

    // create INSERT query
    $qry = $conn->prepare("INSERT INTO user(name, email, password) VALUES(?, ?, ?)");
    $qry->bind_param("sss", $name, $mail, $password);

    // check whether the query was successful or not
    if ($qry->execute() == FALSE) {
      $userErrFlag = true;
    }
    
    // close connection
    $qry->close();
    $conn->close();
    
    if (!$userErrFlag) {
      $_SESSION['Username'] = $name;
      header('Location: https://scary-nerves.000webhostapp.com/index.php');
      exit;
    }
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
    <link rel="stylesheet" href="css/form.css">
    <script language="JavaScript" src="js/form.js"></script>
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
      <h1 id="form-content_title">Sign up</h1>
      
      <!-- form -->
      <form name="signup" method="post" action="signup.php" onsubmit="return signupFormValidate()">
        <?php if ($userErrFlag) { ?>
        <p class="error">This user has been already registerd.</p>
        <?php } ?>

        <!-- username -->
        <p id="error-username" class="nonError"></p>
        <input type="text" name="Username" id="username" placeholder="Enter user name" maxlength="15">

        <!-- e-mail -->
        <p id="error-email" class="nonError"></p>
        <input type="e-mail" name="E-mail" id="email" placeholder="Enter e-mail adress" maxlength="30">
            
        <!-- password -->
        <p id="error-password" class="nonError"></p>
        <input type="password" name="Password" id="password" placeholder="Enter password" maxlength="10">

        <!-- newsletter -->
        <div id="newsLetter">
          <div>Subscribe to our newsletter?</div>
          <input type="radio" name="NewsletterSubscription" value="Yes" id="newsletterYes" checked>Yes
          <input type="radio" name="NewsletterSubscription" value="No" id="newsletterNo">No
        </div>
            
        <!-- login button -->
        <div id="form-button-area"><button type="submit" id="form-button">Sign up</button></div>

        <!-- link to Signup page -->
        <div id="lead-link">
          Do you already have an account?<a href="login.php">LOGIN</a>
        </div>
      </form>
      
    </div>
    
    <!-- footer -->
    <div id="footer">
      <a href="about.php" id="footer-about">About</a>
      <p>Portfolio website developed by php, html, etc. in 2017</p>
    </div>
    
  </body>

</html>