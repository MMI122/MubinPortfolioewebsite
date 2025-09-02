<?php
    session_start();
    if(isset($_POST["login"])){
        include "../conn.php";
        $query = $con_PDO->prepare('SELECT * FROM `users` WHERE name = :name and password = :pass;');
        $query ->bindParam('name',$_POST["name"]);
        $query ->bindParam('pass',$_POST["pass"]);
        $query ->execute();
        if($query->rowCount() === 1){
            $_SESSION["name"] = $_POST["name"];
            header("Location: home.php");
        }else{
            $_SESSION["error"] = "Name and password don't match<br>Please try again";
            header("Location: index.php");
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
    <title>Log in</title>
    <link rel="stylesheet" href="../styles/main.css" />
    <link rel="stylesheet" href="../styles/login.css" />
  </head>
  <body>
    <div class="container f-center">
      <div class="login">
        <div class="img">
          <img src="../images/logo-colors.png" alt="" />
        </div>
        <form action="" method="post" class="grid gap10">
          <input type="text" name="name" placeholder="Enter name" />
          <input type="password" name="pass" placeholder="Enter Password" />
          <button type="submit" name="login">Login</button>
          <?php
            if(isset($_SESSION["error"])){
                echo("<h4 style='color:red; text-align:center'>".$_SESSION["error"]."</h4");
            }
          ?>
        </form>
      </div>
    </div>
  </body>
</html>
