<?php
session_start();
include "../conni.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$message = "";

// Add entry
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $institution = $_POST['institution'];
    $year = $_POST['year'];
    $description = $_POST['description'];
    $order_num = (int)$_POST['order_num'];

    $query = "INSERT INTO education_timeline (title, institution, year, description, order_num) 
              VALUES ('$title', '$institution', '$year', '$description', $order_num)";
    mysqli_query($con_mysqli, $query);
    $message = "Added successfully!";
}

// Delete entry
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($con_mysqli, "DELETE FROM education_timeline WHERE id=$id");
    $message = "Deleted!";
}

// Fetch all
$result = mysqli_query($con_mysqli, "SELECT * FROM education_timeline ORDER BY order_num, year DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin - Education</title>
    <style>
        body {
            font-family: Arial;
            padding: 30px;
            background: #f8f9fa;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .message {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            margin: 20px 0;
            padding: 20px;
            background: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 8px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #555;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            height: 80px;
        }

        button {
            padding: 10px 20px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }

        .action a {
            color: red;
            font-weight: bold;
        }

        .logout {
            float: right;
            color: #007BFF;
            margin-bottom: 20px;
        }

        .back {
            display: block;
            margin-bottom: 20px;
            color: #007BFF;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="../education.php" class="back">&larr; Back to Site</a>
        <a href="logout.php" class="logout">Logout</a>

        <h2>Manage Education Timeline</h2>

        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="POST">
            <h3>Add New Entry</h3>
            <label>Title</label>
            <input type="text" name="title" required>

            <label>Institution</label>
            <input type="text" name="institution" required>

            <label>Year</label>
            <input type="text" name="year" required>

            <label>Description</label>
            <textarea name="description" placeholder="Details..."></textarea>

            <label>Order (number)</label>
            <input type="number" name="order_num" value="0">

            <button type="submit" name="add">Add</button>
        </form>

        <h3>Current Entries</h3>
        <table>
            <tr>
                <th>Title</th>
                <th>Institution</th>
                <th>Year</th>
                <th>Order</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['institution']; ?></td>
                    <td><?php echo $row['year']; ?></td>
                    <td><?php echo $row['order_num']; ?></td>
                    <td class="action">
                        <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>

</html>