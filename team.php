<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="styles/all.min.css" />
  <link rel="stylesheet" href="styles/v4-shims.min.css" />
  <link rel="stylesheet" href="styles/team.css" />
  <link rel="stylesheet" href="styles/main.css" />
</head>

<body>
  <header class="f-around">
    <div class="logo"></div>
    <nav>
      <a href="index.php">Home</a>
      <a href="services.php">services</a>
      <a href="projects.php">projects</a>
      <a href="customers.php">customers</a>
      <a href="team.php" id="active">team</a>
      <a href="contact.php">contact</a>
    </nav>
    <div class="icons">
      <a href="https://www.facebook.com/SamaMedia.co?mibextid=ZbWKwL"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-telegram"></i></a>
    </div>
    <div class="BTNSIDER" id="BTNSIDER"></div>
  </header>
  <div class="font"></div>
  <aside id="sider">
    <div class="logo"></div>
    <nav>
      <a href="index.php">Home</a>
      <a href="services.php">services</a>
      <a href="projects.php">projects</a>
      <a href="customers.php">customers</a>
      <a href="team.php" id="active">team</a>
      <a href="contact.php">contact</a>
    </nav>
    <div class="icons">
      <a href="#"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-telegram"></i></a>
    </div>
  </aside>
  <div class="container f-center">
    <h2 class="main-text">Team</h2>
  </div>

  <div class="team f-evenly">
    <?php
    include "conn.php";
    if ($con_mysqli) {
      $query = "SELECT * FROM team";
      $result = mysqli_query($con_mysqli, $query);
      $row_com = mysqli_num_rows($result);
      if ($row_com > 0) {
        while ($data_main = mysqli_fetch_assoc($result)) {
    ?>
          <div class="box rad10 f-center f-column">
            <img src="images/<?php echo $data_main["t_image"]; ?>" alt="">
            <div class="info f-around">
              <span><?php echo $data_main["t_name"]; ?></span>
              <p><?php echo $data_main["t_job"]; ?></p>
            </div>
          </div>
    <?php
        }
      }
    } else {
      echo 'fales';
    }
    ?>
  </div>

  <footer>
    <div class="footer" style="background-image: url('images/footer-1.jpg')">
      <div class="links">
        <a href="index.php">Home</a>
        <a href="services.php">services</a>
        <a href="projects.php">projects</a>
        <a href="customers.php">customers</a>
        <a href="team.php" id="active">team</a>
        <a href="contact.php">contact</a>
      </div>
      <div class="logo">
        <img src="images/logo-colors.png" alt="logo" />
        <p>Sama Media</p>
      </div>
      <div class="contact">
        <h3>Phone Numbers</h3>
        <p class="phone">+ 880 246 894 2097</p>
        <p class="phone">+ 880 156 789 3041</p>
        <h3>Social Media</h3>
        <span>
          <a href="https://www.facebook.com/SamaMedia.co?mibextid=ZbWKwL">
            <i class="fa fa-facebook">&nbsp; Facebook</i></a>
          <a href=""> <i class="fa fa-instagram"> &nbsp;Instagram</i></a>
          <a href=""> <i class="fa fa-whatsapp"> &nbsp;Whatsapp</i></a>
        </span>
      </div>
      <i class="copyright">All copyright saved &copy;</i>
    </div>
  </footer>
  <a class="scroll" href="#">
    <i class="fa fa-arrow-up"></i>
  </a>
  <script src="scripts/script.js"></script>
</body>

</html>