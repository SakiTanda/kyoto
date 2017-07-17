<?php
  session_start();
  header('X-Frame-Options: DENY');

  $loginflag = false;
  $topicId = 7;

  // get the POST values
  $name = $_SESSION['Username'];
  if (!empty($name)) {
    $loginflag = true;
  }

  // include database connection details
  require_once('config.php');
  
  // connect to mysql server
  $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE);
  if($conn->connect_error) {
    echo('Failed to connect to server: ' . $conn->connect_error);
    exit;
  }
  
  if ($loginflag) {
    if (!empty($_POST['comment'])) {
      
      // get the POST values
      $comment = htmlspecialchars(mysqli_real_escape_string($conn, trim($_POST['comment'])));

      // create INSERT query
      $sql = "INSERT INTO comment (topic, comment, userid) SELECT ".$topicId.", '".$comment."', id FROM user WHERE name = '".$name."'";

      if ($conn->query($sql) === FALSE) {
        echo('Error: '. $sql . '<br>' . $conn->error);
      }
    }
  }

  // create SELECT query
  $sql = "SELECT comment.comment, comment.date, user.name FROM comment, user WHERE comment.topic = ".$topicId." AND comment.userid = user.id ORDER BY comment.date";
  
  $result = $conn->query($sql);
  if ($result === FALSE) {
    echo('Get comments error: '. $conn->error);
  }
  
  // close connection
  $conn->close();
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
    <div id="head-container" style="background-image:url(images/nijo_1.jpg);">
      <div class="head-title">Nijo Castle</div>
    </div>

    <!-- content -->
    <div id="content">
      <table id="content-table">
        <tr class="verticalTop">
          <td width="30%">
            <div class="spaceTop">
              <img src="images/nijo_2.jpg" alt="nijo1" class="content-image">
            </div>
          </td>
          <td width="70%">
            <div class="spaceTop">
              <p class="titleLeft">Location & Information</p>
              <span class="textLeft">Location: Central Kyoto, close to the Nijojo-mae Station along the Tozai Subway line</span><br>
              <span class="textLeft">Hours: 8:45AM - 17:00PM</span><br>
              <span class="textLeft">Admission: 600 yen</span>
            </div>
          </td>
        </tr>
        <tr class="verticalTop">
          <td>
            <div>
              <img src="images/nijo_3.jpg" alt="nijo2" class="content-image">
            </div>
          </td>
          <td>
            <div>
              <span class="titleLeft">Description</span>
              <p class="textLeft">The Nijo Castle is a famous castle that was built in 1603 during the Edo Period. After the collapse of the Tokugawa Shogunate in 1867, the Nijo Castle temporarily became the imperial palace of Japan. The castle itself showcases preserved examples of Japanese castle architecture and craftsmanship of the Japanese feudal era.</p>
              <p class="textLeft">The castle is divided into three parts: the Honmaru (main defense circle), the Ninomaru (secondary defense circle) and the gardens that encircle the two. The entire castle is surrounded by stone walls and tactical moats that were used during the Japanese feudal era.</p>
              <p class="textLeft">Visitors can enter the castle through the main gate on the east side of the castle. Once inside, visitors are free to explore the Ninomaru Palace and the Ninomaru Garden. The Honmaru area is restricted off to the public, but visitors can enjoy the Honmaru gardens just outside.</p>
              <p class="textLeft">Visitors are strongly encouraged to come during the late March and throughout the entire month of April due to the enormous number of cherry blossom trees that bloom during this time. Additionally, the castle has a plum orchard that blooms from late February to early March.</p>
            </div>
          </td>
        </tr>
      </table>
    </div>

    <!-- reviews -->
    <?php if ($result->num_rows > 0 || $loginflag) { ?>
      <table id="comment-table">
        <tr>
          <td>
            <div id="comment-review">
              <span class="gray"><span class="titleLeft">Reviews</span></span>
            </div>
          </td>
        </tr>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr class="comment-form">
          <td>
            <div class="floatLeft"><span class="gray"><?php echo $row["date"] ?></span></div><br>
            <div class="comment-display"><?php echo nl2br($row["comment"]) ?></div><br><br>
            <div class="floatclear"></div>
            <div class="floatRight"><span class="gray">by </span><span class="blue"><?php echo $row["name"] ?></span></div> 
          </td>
        </tr>
      <?php } ?>
      </table>
    <?php } ?>
    <?php $result->close(); ?>
    <?php if ($loginflag) { ?>
      <form name="comment" method="post" action="sight1.php">
        <table id="comment-table">
          <tr>
            <td>
              <textarea class="comment-textarea" name="comment" id="taComment" rows="5" maxlength="300"></textarea>
            </td>
          </tr>
          <tr>
            <td id="comment-post-button">
              <input type="submit" value="post">
            </td>
          </tr>
        </table>
      </form>
    <?php } ?>
    </div>
    
    <!-- footer -->
    <div class="spaceTopForFooter"></div>
    <div id="footer">
      <a href="about.php" id="footer-about">About</a>
      <p>Portfolio website developed by php, html, etc. in 2017</p>
    </div>

  </body>

</html>
