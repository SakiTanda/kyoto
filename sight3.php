<?php
  session_start();
  header('X-Frame-Options: DENY');

  $loginflag = false;
  $topicId = 9;

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
    <div id="head-container" style="background-image:url(images/inari_1.jpg);">
      <div class="head-title">Fushimi Inari Shrine</div>
    </div>

    <!-- content -->
    <div id="content">
      <table id="content-table">
        <tr class="verticalTop">
          <td width="30%">
            <div class="spaceTop">
              <img src="images/inari_2.jpg" alt="inari1" class="content-image">
            </div>
          </td>
          <td width="70%">
            <div class="spaceTop">
              <p class="titleLeft">Location & Information</p>
              <span class="textLeft">Location: Southern Kyoto, close to the Fushimi Inari Station along the Keihan Main Line</span><br>
              <span class="textLeft">Hours: Always Open</span><br>
              <span class="textLeft">Admission: Free</span>
            </div>
          </td>
        </tr>
        <tr class="verticalTop">
          <td>
            <div>
              <img src="images/inari_3.jpg" alt="inari2" class="content-image">
            </div>
          </td>
          <td>
            <div>
              <span class="titleLeft">Description</span>
              <p class="textLeft">A famous Shinto shrine that is renowned for it’s thousands of torri gates which trail off from the main building. Fushimi Inari was built to honor and respect Inari, the Shinto god of rice. The shrine contains several statues of foxes which are believed to be the messengers of Inari.</p>
              <p class="textLeft">Visitors who enter the shrine grounds are first greeted with the Romon Gate which stands at the entrance. At the shrine, visitors can observe the detailed craftsmanship that was used to construct the shrine and the surrounding statues.</p>
              <p class="textLeft">The Fushimi Inari Shrine is most known for the Senbon Torii, the thousands of torii gates that reside just behind the shrine. The gates cover the hiking trails and each gate has been inscribed with the individual or company that helped donate the gate to create the torii gate covered trail. Visitors have the option to follow the trail and scale Mount Inari to see the spectacular sight from top. However, most people do not choose to go all the way.</p>
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
      <form name="comment" method="post" action="sight3.php">
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
