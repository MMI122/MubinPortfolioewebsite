<?php 
    session_start();
    // --------- Add
    if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['add'])) {
        $Image = $_FILES['Image']['name'];
        
        if ($_FILES['Image']['name'] != "") {
            $targetDir = '../images/';
            $fileName = basename($_FILES['Image']['name']);
            $targetFile = $targetDir . $fileName;
            if (move_uploaded_file($_FILES['Image']['tmp_name'], $targetFile)) {
                $Image = $fileName;
            } 
            else {
                $_SESSION["error"] = "<br>Error uploading the image file.";
                header("Location: projects.php");
                return;
            }
        }

        include_once "../conn.php";
        if ($con_mysqli) {
            $query = "INSERT INTO projects (p_image) values ('$Image')";
            $result = mysqli_query($con_mysqli, $query);
            if ($result) {
                $_SESSION["message"] = "<br>projects Added successfully.";
                header("Location: projects.php");
                return;
            } 
            else {
                $_SESSION["error"] = "<br>Error Adding projects: " . mysqli_error($con_mysqli);
                header("Location: projects.php");
                return;
            }
        } 
        else {
            $_SESSION["error"] = "<br>Failed to connect to the database.";
            header("Location: projects.php");
            return;
        }
    }

    // --------- Edit
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["edit"]) ) {
        if(isset($_FILES['Image']['name']) || isset($_POST['ImageOld']) ){

            $Id = $_POST['Id'];
            $ImageOld = $_POST['ImageOld'];

            if(isset($_FILES['Image']['name']) && $_FILES['Image']['name'] != ""){
                $Image = $_FILES['Image']['name'];
            }else{
                $Image = $ImageOld;
            }

            if( $Image != $ImageOld){
                $targetDir = '../images/';
                $fileName = basename($_FILES['Image']['name']);
                $targetFile = $targetDir . $fileName;
            
                if (move_uploaded_file($_FILES['Image']['tmp_name'], $targetFile)) {
                    $Image = $fileName;
                } 
                else {
                    $_SESSION["error"] = "<br>Error uploading the image file.";
                    header("Location: projects.php");
                    return;
                }
            }

            include_once "../conn.php";
            if ($con_mysqli) {
                $query = "UPDATE projects SET  p_image = '$Image' WHERE p_id = '$Id'";
                $result = mysqli_query($con_mysqli, $query);
                if ($result) {
                    $_SESSION["message"] = "<br>Customer updated successfully.";
                    header("Location: projects.php");
                    return;
                } 
                else {
                    $_SESSION["error"] = "<br>Error updating customer: " . mysqli_error($con_mysqli);
                    header("Location: projects.php");
                    return;
                }
            } else {
                $_SESSION["error"] = "<br>Failed to connect to the database.";
                header("Location: projects.php");
                return;
            }
        }
    }

    // -------- Delete
    if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['delete'])) {
        if(isset($_POST['Id']) ){
            $Id = $_POST['Id'];

            include_once "../conn.php";
            if ($con_mysqli) {
                $query = "DELETE FROM projects WHERE p_id = '$Id'";
                $result = mysqli_query($con_mysqli, $query);
                if ($result) {
                    $_SESSION["message"] = "<br>projects Deleted successfully.";
                    header("Location: projects.php");
                    return;
                } 
                else {
                    $_SESSION["error"] = "<br>Error updating projects: " . mysqli_error($con_mysqli);
                    header("Location: projects.php");
                    return;
                }
            } else {
                $_SESSION["error"] = "<br>Failed to connect to the database.";
                header("Location: projects.php");
                return;
            }
        }
    }
    session_abort();

    include_once 'header.php' 
?>

<div class="pop-add pop-message">
    <h3>Do you want to Add some thing?</h3>
    <form action="" method="post"  enctype="multipart/form-data">
        <input type="file" name="Image" accept="image/*" require/>
        <button class="submit" name="add" type="submit">Add</button>
        <button class="cancel">Cancel</button>
       
    </form>
</div>

<div class="pop-edit pop-message">
    <h3>Do you want to edit it?</h3>
    <form action="" method="post"  enctype="multipart/form-data">
        <input type="hidden" name="Id" >
        <div id="imageContainer"></div>
        <input type="file" name="Image" accept="image/*" />
        <input type="hidden" name="ImageOld" >
        <button class="submit" name="edit">Edit</button>
        <button class="cancel" >Cancel</button>
        
    </form>
</div>

<div class="pop-delete pop-message">
    <h3>Do you want to delete it?</h3>
    <form action="" method="post">
        <input type="hidden" name="Id" >
        <button class="submit" name="delete" type="submit">OK</button>
        <button class="cancel">Cancel</button>
    </form>
</div>

<div class="page">
    <h1>Projects</h1>
    <div class="content">
        <?php 
            include_once "../conn.php";
            if($con_mysqli){
                $query="SELECT * FROM projects";
                $result=mysqli_query($con_mysqli,$query);
                $row_com=mysqli_num_rows($result);
                if($row_com>0){
                    while($data_main=mysqli_fetch_assoc($result)){
                ?>
                    <div class="box shad-bx" id="<?php echo $data_main['p_id']?>">
                        <div class="img">
                            <img src="../images/<?php echo $data_main['p_image']?>" alt="">
                        </div>
                        <div class="info">
                            <div class="icons">
                                <div class="edit"
                                    data-id="<?php echo $data_main['p_id'] ?>" 
                                    data-image="<?php echo $data_main['p_image'] ?>">
                                    <i class="fa fa-edit"></i>
                                </div>
                                <div class="delete" data-id="<?php echo $data_main['p_id'] ?>">
                                    <i class="fa fa-trash"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                }
            }
            else{
                echo 'fales';
            }
        ?>
    </div>
</div>

<a class="scroll add" href="#" style="display:block; bottom:20px">
    <i class="fa fa-plus"></i>
</a>

<?php include_once 'footer.php' ?>