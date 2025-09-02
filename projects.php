<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Publications by Mubin Islam</title>
  <link rel="stylesheet" href="styles/all.min.css" />
  <link rel="stylesheet" href="styles/v4-shims.min.css" />
  <link rel="stylesheet" href="styles/main.css" />

  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" /> -->
  <link rel="stylesheet" href="styles/swiper.css" />
  <link rel="stylesheet" href="styles/projects.css" />
</head>

<body>
  <header class="f-around">
    <div class="logo"></div>
    <!-- <nav>
        <a href="index.php">Home</a>
        <a href="services.php">services</a>
        <a href="projects.php" id="active">projects</a>
        <a href="customers.php">customers</a>
        <a href="team.php">team</a>
        <a href="contact.php">contact</a>
      </nav> -->
    <nav>
      <a href="index.php">Home</a>
      <a href="services.php">Experience</a>
      <a href="projects.php" id="active">Publications</a>
      <!-- <a href="customers.php">Customers</a> -->
      <a href="education.php">Education</a>
      <!-- <a href="team.php">Team</a> -->
      <a href="practice/index.php">projects</a>
      <a href="contact.php">Contact</a>
    </nav>
    <div class="icons">
      <a href="https://www.facebook.com/mubinislam.alif.1"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-telegram"></i></a>
    </div>
    <div class="BTNSIDER" id="BTNSIDER"></div>
  </header>

  <div class="font"></div>
  <aside id="sider">
    <div class="logo"></div>
    <nav>
      <a href="index.php">Home</a>
      <a href="services.php">Experience</a>
      <a href="projects.php" id="active">Publications</a>
      <!-- <a href="customers.php">Customers</a> -->
      <a href="education.php">Education</a>
      <!-- <a href="team.php">Team</a> -->
      <a href="practice/index.php">projects</a>
      <a href="contact.php">Contact</a>
    </nav>
    <div class="icons">
      <a href="#"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-telegram"></i></a>
    </div>
  </aside>
  <div class="container f-center">
    <h2 class="main-text">publications</h2>
  </div>

  <div style="margin: 50px 0">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <?php include "conn.php";
        if ($con_mysqli) {
          $query = "SELECT * FROM projects ORDER BY p_id DESC";
          $result = mysqli_query($con_mysqli, $query);
          $row_com = mysqli_num_rows($result);
          if ($row_com > 0) {
            while ($data_main = mysqli_fetch_assoc($result)) {
        ?>
              <div class="swiper-slide">
                <img src="images/<?php echo $data_main["p_image"]; ?>" alt="">
              </div>
        <?php
            }
          }
        } else {
          echo 'fales';
        }
        ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
  <footer>
    <div class="footer" style="background-image: url('images/footer-1.jpg')">
      <div class="links">
        <a href="index.php">home</a>
        <a href="services.php">experience</a>
        <a href="projects.php" id="active">Publications</a>
        <!-- <a href="customers.php">Customers</a> -->
        <a href="education.php">education</a>
        <!-- <a href="team.php">Team</a> -->
        <a href="practice/index.php">projects</a>
        <a href="contact.php">contact</a>
      </div>
      <div class="logo">
        <img src="images/logo-colors.png" alt="logo" />
        <!-- <p>Sama Media</p> -->
      </div>
      <div class="contact">
        <h3>Phone Numbers</h3>
        <p class="phone">+ 880 246 894 2097</p>
        <p class="phone">+ 880 156 789 3041</p>
        <h3>Social Media</h3>
        <span>
          <a href="https://www.facebook.com/mubinislam.alif.1">
            <i class="fa fa-facebook">&nbsp; Facebook</i></a>
          <a href=""> <i class="fa fa-instagram"> &nbsp;Instagram</i></a>
          <a href=""> <i class="fa fa-whatsapp"> &nbsp;Whatsapp</i></a>
        </span>
      </div>
      <!-- <i class="copyright">All copyright saved &copy;</i> -->
    </div>
  </footer>
  <a class="scroll" href="#">
    <i class="fa fa-arrow-up"></i>
  </a>
  <script src="scripts/swiper.js"></script>
  <script>
    var swiper = new Swiper(".mySwiper", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
      },
      pagination: {
        el: ".swiper-pagination",
      },
    });
  </script>
  <script src="scripts/script.js"></script>
</body>

</html>