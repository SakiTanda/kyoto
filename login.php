<?php
  session_start();
  header('X-Frame-Options: DENY');
  
  // include database connection details
  require_once('config.php');

  // error flag of user 
  $userErrFlag = false;


  if (!empty($_POST['Username']) && !empty($_POST['Password'])) {
  
    // connect to mysql server
    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE);
    if($conn->connect_error) {
      echo('Failed to connect to server: ' . $conn->connect_error);
      exit;
    }

    // get the POST values & escape strings
    $name = mysqli_real_escape_string($conn, trim($_POST['Username']));
    $password = trim($_POST['Password']);

    // create SELECT query
    $qry = $conn->prepare("SELECT password FROM user WHERE name = ?");
    $qry->bind_param("s", $name);

    // check whether the query was successful or not
    if ($qry->execute() == FALSE) {
      $userErrFlag = true;
    } else {
      
      // check the number of the result
      $qry->store_result();
      if ($qry->num_rows != 1) {
        $userErrFlag = true;
      } else {
        
        // check password
        $qry->bind_result($hash_password);
        while ($qry->fetch()) {
          if (!password_verify($password, $hash_password)) {
            $userErrFlag = true;
          }
        }
      }
    }
    
    // close connection
    $qry->close();
    $conn->close();
    
    // success of login
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
      <h1 id="form-content_title">Login</h1>
      
      <!-- form -->
      <form name="login" method="post" action="login.php" onsubmit="return loginFormValidate()">
        <?php if ($userErrFlag) { ?>
        <p class="error">This user doesn't exist.</p>
        <?php } ?>
        
        <!-- username -->
        <p id="error-username" class="nonError"></p>
        <input type="text" name="Username" id="username" placeholder="Enter user name" maxlength="15">

        <!-- password -->
        <p id="error-password" class="nonError"></p>
        <input type="password" name="Password" id="password" placeholder="Enter password" maxlength="10">

        <!-- login button -->
        <div id="form-button-area"><button type="submit" id="form-button">Login</button></div>

        <!-- link to Signup page -->
        <div id="lead-link">
          Don't have an account?<a href="signup.php">SIGN UP</a>
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