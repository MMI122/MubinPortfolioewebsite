<?php 
    // --------- DELETE
    if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['delete'])) {
        if(isset($_POST['Id']) ){
            $Id = $_POST['Id'];
            include_once "../conn.php";
            if ($con_mysqli) {
                $query = "DELETE FROM message WHERE m_id = '$Id'";
                $result = mysqli_query($con_mysqli, $query);
                if ($result) {
                    $_SESSION["message"] = "<br>Message Deleted successfully.";
                    header("Location: message.php");
                    return;
                } 
                else {
                    $_SESSION["error"] = "<br>Error deleting Team: " . mysqli_error($con_mysqli);
                    header("Location: message.php");
                    return;
                }
            } else {
                $_SESSION["error"] = "<br>Failed to connect to the database.";
                header("Location: message.php");
                return;
            }
        }
    }

    include_once 'header.php';  
?>

<div class="pop-delete pop-message">
    <h3>Do you want to delete it?</h3>
    <form action="" method="post">
        <input type="hidden" name="Id" >
        <button class="submit" name="delete" type="submit">OK</button>
        <button class="cancel">Cancel</button>
    </form>
</div>

<div class="page">
    <h1>Messages</h1>
    <div class="messages">

        <?php
            include_once "../conn.php";

            $quary = 'SELECT * FROM `message` ORDER BY m_date' ;
            $stmt = $con_PDO->prepare($quary);

            // Execute the statement
            $stmt->execute();

            // Fetch all the messages as an associative array
            $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Loop through the messages and display them in the dashboard
            foreach ($messages as $message) {
                ?>
                    <div class='message shad-bx'>
                        <div class='info'>
                            <p class='name'>name: <?php echo $message['m_name']; ?></p>
                            <p class='phone'>Phone: <?php echo $message['m_phone']; ?></p>
                            <p class='date'>Date: <?php echo $message['m_date']; ?></p>
                        </div>
                        <div class="action f-evenly f-reverce">
                        <button>Show message
                        <p class='text'><?php echo $message['m_note']; ?></p>
                        </button>
                        <div class="delete" data-id="<?php echo $message['m_id'] ?>"><i class="fa fa-trash"></i></div>
                        </div>
                    </div>
                <?php
            }
        ?>
    </div>
</div>

<?php include_once 'footer.php' ?>