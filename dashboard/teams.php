<?php 
    session_start();
    // --------- Add
    if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['add'])) {
        $Name = $_POST['Name'];
        $Job = $_POST['Job'];
        $Gender = $_POST['Gender'];
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
                header("Location: teams.php");
                return;
            }
        }else if($Gender == "male")
            $Image = "male.png";
        else if($Gender == "female")
            $Image = "female.png";

        include_once "../conn.php";
        if ($con_mysqli) {
            $query = "INSERT INTO team (t_name,t_job,t_image,gender) values ('$Name','$Job','$Image','$Gender')";
            $result = mysqli_query($con_mysqli, $query);
            if ($result) {
                $_SESSION["message"] = "<br>Team Added successfully.";
                header("Location: teams.php");
                return;
            } 
            else {
                $_SESSION["error"] = "<br>Error Adding Team: " . mysqli_error($con_mysqli);
                header("Location: teams.php");
                return;
            }
        } 
        else {
            $_SESSION["error"] = "<br>Failed to connect to the database.";
            header("Location: teams.php");
            return;
        }
    }

    // --------- edit
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["edit"]) ) {
        if(isset($_FILES['Image']['name']) || isset($_POST['ImageOld']) ){

            $Id = $_POST['Id'];
            $Name = $_POST['Name'];
            $Job = $_POST['Job'];
            $Gender = $_POST['Gender'];
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
                    header("Location: teams.php");
                    return;
                }
            }

            include_once "../conn.php";
            if ($con_mysqli) {
                $query = "UPDATE team SET t_name = '$Name', t_job = '$Job' , gender = '$Gender' , t_image = '$Image' WHERE t_id = '$Id'";
                $result = mysqli_query($con_mysqli, $query);
                if ($result) {
                    $_SESSION["message"] = "<br>Customer updated successfully.";
                    header("Location: teams.php");
                    return;
                } 
                else {
                    $_SESSION["error"] = "<br>Error updating customer: " . mysqli_error($con_mysqli);
                    header("Location: teams.php");
                    return;
                }
            } else {
                $_SESSION["error"] = "<br>Failed to connect to the database.";
                header("Location: teams.php");
                return;
            }
        }
    }

    // --------- delete
    if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['delete'])) {
        if(isset($_POST['Id']) ){
            $Id = $_POST['Id'];

            include_once "../conn.php";
            if ($con_mysqli) {
                $query = "DELETE FROM team WHERE t_id = '$Id'";
                $result = mysqli_query($con_mysqli, $query);
                if ($result) {
                    $_SESSION["message"] = "<br>Team Deleted successfully.";
                    header("Location: teams.php");
                    return;
                } 
                else {
                    $_SESSION["error"] = "<br>Error deleting Team: " . mysqli_error($con_mysqli);
                    header("Location: teams.php");
                    return;
                }
            } else {
                $_SESSION["error"] = "<br>Failed to connect to the database.";
                header("Location: teams.php");
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
        <input type="text" name="Name" placeholder="Team Name" />
        <input type="text" name="Job" placeholder="Job Title" />
        <input type="file" name="Image" accept="image/*" />
        <select name="Gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        <button class="submit" name="add" type="submit">Add</button>
        <button class="cancel">Cancel</button>
    </form>
    <script>
        document.querySelector('.pop-add input[name="Name"]').value = "";
    </script>
</div>

<div class="pop-edit pop-message">
    <h3>Do you want to edit it?</h3>
    <form action="" method="post"  enctype="multipart/form-data">
        <input type="hidden" name="Id" >
        <input type="text" name="Name" placeholder="Team Name" />
        <input type="text" name="Job" placeholder="Job Title" />
        <div id="imageContainer"></div>
        <input type="file" name="Image" accept="image/*" />
        <select name="Gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        <input type="hidden" name="ImageOld" >
        <button class="submit" name="edit" >Edit</button>
        <button class="cancel">Cancel</button>
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
    <h1>Teams</h1>
    <div class="content">
            <?php 
                include_once "../conn.php";
                if($con_mysqli){
                    $query="SELECT * FROM team";
                    $result=mysqli_query($con_mysqli,$query);
                    $row_com=mysqli_num_rows($result);
                    if($row_com>0){
                        while($data_main=mysqli_fetch_assoc($result)){
                        ?>
                        <div class="box team shad-bx">
                            <div class="img">
                                <img src="../images/<?php echo $data_main['t_image']?>" alt="">
                            </div>
                            <div class="info">
                                <div class="text"><?php echo $data_main['t_name']?></div>
                                <div class="icons">
                                    <div class="edit"
                                        data-id="<?php echo $data_main['t_id'] ?>" 
                                        data-name="<?php echo $data_main['t_name'] ?>" 
                                        data-image="<?php echo $data_main['t_image'] ?>"
                                        data-job="<?php echo $data_main['t_job'] ?>"
                                        data-gender="<?php echo $data_main['gender'] ?>">
                                        <i class="fa fa-edit"></i>
                                    </div>
                                    <div class="delete" data-id="<?php echo $data_main['t_id'] ?>">
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
<?php 
if(isset($_SESSION["error"])){
    echo $_SESSION["error"];
    unset($_SESSION["error"]);
}
?>
<a class="scroll add" href="#" style="display:block; bottom:20px">
    <i class="fa fa-plus"></i>
</a>

<?php include_once 'footer.php' ?>