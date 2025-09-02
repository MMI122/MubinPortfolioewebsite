<?php
session_start();
include 'conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['message'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $date = date("Y/m/d", time());

    if (empty($name) || empty($phone) || empty($message)) {
      $_SESSION["error"] = "Please enter all your infromation";
      header("Location: contact.php");
      return;
    }


    $sql = "INSERT INTO message (m_name, m_phone, m_note,m_date) VALUES (:name, :phone, :message,:date)";
    $stmt = $con_PDO->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':date', $date); // Execute the statement 
    $stmt->execute(); // Display a success message 
    $_SESSION["message"] = "Your message has been sent successfully!";
    header("Location: contact.php");
    return;
  } else {
    $_SESSION["error"] = "Please enter all your information!";
    header("Location: contact.php");
    return;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="styles/all.min.css" />
  <link rel="stylesheet" href="styles/v4-shims.min.css" />
  <link rel="stylesheet" href="styles/main.css" />
  <link rel="stylesheet" href="styles/contact.css" />
</head>

<body>
  <!-- header -->
  <header class="f-around">
    <div class="logo"></div>
    <nav>
      <!-- <a href="index.php">Home</a>
        <a href="services.php">services</a>
        <a href="projects.php">projects</a>
        <a href="customers.php">customers</a>
        <a href="team.php">team</a>
        <a href="contact.php" id="active">contact</a> -->
      <a href="index.php">Home</a>
      <a href="services.php">Experience</a>
      <a href="projects.php">publications</a>
      <!-- <a href="customers.php">customers</a> -->
      <a href="education.php">Education</a>
      <a href="practice/index.php">projects</a>
      <a href="contact.php" id="active">contact</a>
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
      <a href="projects.php">publications</a>
      <!-- <a href="customers.php">customers</a> -->
      <a href="education.php">Education</a>
      <a href="practice/index.php">projects</a>
      <a href="contact.php" id="active">contact</a>
    </nav>
    <div class="icons">
      <a href="#"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-telegram"></i></a>
    </div>
  </aside>
  <div class="container f-center">
    <h2 class="main-text">contact me</h2>
  </div>

  <form action="" class="f-center" method="post">
    <h1>Enter your information</h1>
    <input type="text" name="name" placeholder="Enter full Name..." require />
    <input type="text" name="phone" placeholder="Enter phone..." require />
    <textarea
      name="message"
      placeholder="Eneter your message..."
      require></textarea>
    <button type="submit"><i class="fa fa-send"></i> Send</button>
    <h3 style="color: green; margin-top: 16px;" ;>
      <?php
      if (isset($_SESSION["message"])) {
        echo $_SESSION["message"];
        unset($_SESSION["message"]);
      }
      ?>
    </h3>
    <h3 style="color: red; margin-top: 16px;" ;>
      <?php
      if (isset($_SESSION["error"])) {
        echo $_SESSION["error"];
        unset($_SESSION["error"]);
      }
      ?>
    </h3>
  </form>

  <!-- footer -->
  <footer>
    <div class="footer" style="background-image: url('images/footer-1.jpg')">
      <div class="links">
        <a href="index.php">Home</a>
        <a href="services.php">Experience</a>
        <a href="projects.php">Publications</a>
        <!-- <a href="customers.php">customers</a> -->
        <a href="education.php">Education</a>
        <a href="practice/index.php">Projects</a>
        <a href="contact.php" id="active">Contact</a>
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
      <i class="copyright">All copyright saved &copy;</i>
    </div>
  </footer>
  <a class="scroll" href="#">
    <i class="fa fa-arrow-up"></i>
  </a>
  <script src="scripts/script.js"></script>
</body>

</html>