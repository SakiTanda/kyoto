<?php
  session_start();
  header('X-Frame-Options: DENY');

  $loginflag = false;
  $topicId = 5;

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
    <div id="head-container" style="background-image:url(images/shojin_4.jpg);">
      <div class="head-title">Shojin Ryori</div>
    </div>

    <!-- content -->
    <div id="content">
      <table id="content-table">
        <tr class="verticalTop">
          <td width="30%">
            <div class="spaceTop">
              <img src="images/shoujin_2.jpg" alt="shojin1" class="content-image">
            </div>
          </td>
          <td width="70%">
            <div class="spaceTop">
              <span class="titleLeft">Description</span>
              <p class="textLeft">Shojin Ryori also known as Buddhist cuisine is served at many temples in Kyoto and consists of purely vegetarian dishes.Shojin Ryori is created with simple preparation with extremely high standards for the food’s quality, wholesomeness, and flavor. Most of the dishes consist of tofu and locally gorwn vegetables.</p>
            </div>
          </td>
        </tr>
        <tr class="verticalTop">
          <td>
            <div>
              <img src="images/shojin_3.jpg" alt="shojin2" class="content-image">
            </div>
          </td>
          <td>
            <div>
              <span class="titleLeft">Recommendation</span>
              <p class="textLeft">For Shojin Ryori we recommend Yoshuji (雍州路), a small sophisticated restaurant in Kyoto that offers vegetarian and vegan Shojin Ryori.</p>
              <span class="textLeft">Address: Japan, Kyoto Prefecture, Kyoto 〒601-1111 京都府京都市左京区鞍馬本町1074−2</span><br>
              <span class="textLeft">Hours of Operation: 10:00am to 6:00pm closed on tuesdays</span><br>
              <span class="textLeft">Price: 2000 - 3000 yen</span><br>
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
      <form name="comment" method="post" action="food2.php">
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
