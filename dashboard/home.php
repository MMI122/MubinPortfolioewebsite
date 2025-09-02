<?php
 include_once 'header.php';
?>

<div class="page">
    <h1>Home</h1>
    <div class="card">
        <!-- تغيير كلمة المرور -->
        <div class="box shad-bx">
            <h2>Change Password</h2>
            <form action="" method="post">
                <input type="password" name="oldpass" placeholder="Enter old password">
                <input type="password" name="newpass" placeholder="Enter new password">
                <input type="password" name="retypepass" placeholder="Re-type the new password">
                <button>Change</button>
                <?php
                    include_once "../conn.php";
                    if($_SERVER["REQUEST_METHOD"]== "POST")
                    {
                        if(isset($_POST["oldpass"]) && isset($_POST["newpass"]) && isset($_POST["retypepass"])){ 
                            $oldpass = trim($_POST['oldpass']);
                            $newpass = trim($_POST['newpass']);
                            $retypepass = trim($_POST['retypepass']);
        
                            if (empty($oldpass) || empty($newpass) || empty($retypepass)) {
                                echo "Please fill in all the fields.";
                            } elseif ($newpass != $retypepass) {
                                echo "The new password and the re-typed password do not match.";
                            } else {
                                $sql = "SELECT password FROM users ";
                                $stmt = $con_PDO->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($result) {
                                    $sql = "UPDATE users SET password = ? ";
                                    $stmt = $con_PDO->prepare($sql);
                                    if ($stmt->execute([$newpass])) {
                                        echo "Password changed successfully.";
                                    } 
                                    else {
                                        echo "Error updating password: " . $stmt->errorInfo()[2];
                                    }
                                }
                                else {
                                echo "User not found.";
                                }
                            }
                        }
                    }
                ?>
            </form>
        </div>
        <!-- اخر الرسائل المرسلة -->
        <div class="box shad-bx">
            <h2>Lastest Messages</h2>
            <div class="messages">
            <?php
                include_once "../conn.php";
                $query = $con_PDO->prepare('SELECT * FROM `message` WHERE m_date >= DATE(NOW()) - INTERVAL 7 DAY ORDER BY m_date DESC;'); 
                $query ->execute();
                if($query->rowCount() > 0){ 
                    while($row = $query->fetch()){
                        ?>
                        <div class="mess">
                            <div class="mes">
                                <span> <?php echo $row["m_name"]; ?></span> 
                                <span><?php echo $row["m_phone"]; ?></span>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo 'No messages found.'; 
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php' ?>