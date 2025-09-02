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
    $title = mysqli_real_escape_string($con_mysqli, $_POST['title']);
    $institution = mysqli_real_escape_string($con_mysqli, $_POST['institution']);
    $year = mysqli_real_escape_string($con_mysqli, $_POST['year']);
    $description = mysqli_real_escape_string($con_mysqli, $_POST['description']);
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
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Education</title>

    <!-- <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
            left: -250px;
            /* Hidden by default on mobile */
            top: 0;
            transition: left 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        /* Show sidebar by default on desktop */
        @media (min-width: 769px) {
            .sidebar {
                left: 0;
            }

            .main-content.shifted {
                margin-left: 250px;
            }

            .toggle-btn {
                display: none !important;
            }
        }

        .sidebar.open {
            left: 0;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.5em;
        }

        .sidebar a {
            color: #ddd;
            text-decoration: none;
            padding: 12px 15px;
            display: block;
            border-radius: 5px;
            margin-bottom: 8px;
            transition: background 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #007BFF;
            color: white;
        }

        /* Toggle Button (Hamburger) */
        .toggle-btn {
            position: fixed;
            top: 15px;
            left: 15px;
            background: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1100;
            display: block;
            /* Will be hidden on desktop via media query */
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 0;
            padding: 30px;
            transition: margin-left 0.3s ease;
        }

        .container {
            max-width: 900px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2.page-title {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
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
            text-decoration: none;
        }

        .back {
            display: block;
            margin-bottom: 20px;
            color: #007BFF;
        }

        .logout {
            color: #007BFF;
            text-decoration: none;
            margin-bottom: 30px;
            display: block;
            text-align: right;
            padding-right: 30px;
        }

        /* Responsive for Mobile */
        @media (max-width: 768px) {
            .toggle-btn {
                display: block;
            }

            .main-content.shifted {
                margin-left: 250px;
            }
        }
    </style> -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #117be6;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
            left: -250px;
            /* Hidden on mobile by default */
            top: 0;
            transition: left 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        /* Show sidebar on desktop */
        @media (min-width: 769px) {
            .sidebar {
                left: 0;
                /* Show it */
            }

            .main-content {
                margin-left: 250px;
                /* Push content to avoid overlap */
            }
        }

        .sidebar.open {
            left: 0;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.5em;
        }

        .sidebar a {
            color: #ddd;
            text-decoration: none;
            padding: 12px 15px;
            display: block;
            border-radius: 5px;
            margin-bottom: 8px;
            transition: background 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #007BFF;
            color: white;
        }

        /* Toggle Button (Hamburger) */
        .toggle-btn {
            position: fixed;
            top: 15px;
            left: 15px;
            background: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1100;
            display: none;
            /* Hidden by default on desktop */
        }

        @media (max-width: 768px) {
            .toggle-btn {
                display: block;
                /* Show only on mobile */
            }
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
            transition: margin-left 0.3s ease;
            /* margin-left will be set by JS on mobile, and by CSS on desktop */
        }

        /* Container stays within visible area */
        .container {
            max-width: 900px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2.page-title {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
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
            text-decoration: none;
        }

        .back {
            display: block;
            margin-bottom: 20px;
            color: #007BFF;
        }

        .logout {
            color: #007BFF;
            text-decoration: none;
            margin-bottom: 30px;
            display: block;
            text-align: right;
            padding-right: 30px;
        }

        /* Responsive for Mobile */
        @media (max-width: 768px) {
            .main-content.shifted {
                margin-left: 250px;
                /* Push content when sidebar is open */
            }
        }
    </style>
</head>

<body>

    <!-- Hamburger Toggle Button -->
    <button class="toggle-btn" id="toggleSidebar">☰ Menu</button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h2>Admin Panel</h2>
        <a href="../dashboard/home.php" class="active">Home</a>

        <a href="../dashboard/projects.php">Publications</a>
        <a href="education.php">Education</a>
        <a href="../dashboard/message.php">Messages</a>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <a href="../education.php" class="back">&larr; Back to Site</a>
        <a href="logout.php" class="logout">Logout</a>

        <div class="container">
            <h2 class="page-title">Manage Education Timeline</h2>

            <?php if ($message): ?>
                <p class="message"><?php echo htmlspecialchars($message); ?></p>
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
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['institution']); ?></td>
                        <td><?php echo htmlspecialchars($row['year']); ?></td>
                        <td><?php echo (int)$row['order_num']; ?></td>
                        <td class="action">
                            <a href="?delete=<?php echo (int)$row['id']; ?>"
                                onclick="return confirm('Delete this entry?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        const sidebar = document.getElementById("sidebar");
        const toggleBtn = document.getElementById("toggleSidebar");
        const mainContent = document.getElementById("mainContent");

        toggleBtn.addEventListener("click", () => {
            const isSidebarOpen = sidebar.classList.contains("open");
            if (isSidebarOpen) {
                sidebar.classList.remove("open");
                mainContent.classList.remove("shifted");
            } else {
                sidebar.classList.add("open");
                mainContent.classList.add("shifted");
            }
        });

        // Close sidebar when clicking a link (mobile UX)
        document.querySelectorAll(".sidebar a").forEach(link => {
            link.addEventListener("click", () => {
                sidebar.classList.remove("open");
                mainContent.classList.remove("shifted");
            });
        });
    </script>

</body>

</html>