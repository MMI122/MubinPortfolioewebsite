<?php
require_once 'auth.php';
if (!isAdminLoggedIn()) {
    header('Location: login.php');
    exit;
}

require_once '../config/db.php';
$message = '';
$categories = ['General', 'Web App', 'Tool', 'API', 'Design'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $github_url = trim($_POST['github_url']);
    $category = $_POST['category'] ?: 'General';
    $image_url = '';

    $upload_dir = '../uploads/';
    $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

    if (isset($_FILES['project_image']) && $_FILES['project_image']['error'] === 0) {
        $file = $_FILES['project_image'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mime_type, $allowed_types)) {
            $message = "❌ Only JPG, PNG, GIF allowed.";
        } else {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = 'project_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
            $destination = $upload_dir . $filename;

            if (move_uploaded_file($file['tmp_name'], $destination)) {
                $image_url = 'uploads/' . $filename;
            } else {
                $message = "❌ Failed to save image.";
            }
        }
    } else {
        $message = "❌ Please upload an image.";
    }

    if ($image_url && $title && $github_url) {
        $stmt = $pdo->prepare("INSERT INTO projects (title, description, image_url, github_url, category) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $description ?: 'No description.', $image_url, $github_url, $category]);
        $message = "✅ Project added!";
    } else {
        $message = "❌ Title, image, and GitHub link are required.";
    }
}

// Fetch projects for list
$stmt = $pdo->query("SELECT id, title FROM projects ORDER BY created_at DESC");
$projects = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <div class="container">
        <h2>➕ Add New Project</h2>
        <?php if ($message): ?>
            <p class="<?php echo strpos($message, '❌') !== false ? 'error' : 'success'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </p>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Project Title" required />
            <textarea name="description" placeholder="Description (use line breaks)"><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>

            <input type="file" name="project_image" accept="image/*" required />
            <select name="category">
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat; ?>"><?php echo $cat; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="url" name="github_url" placeholder="GitHub URL" required />
            <button type="submit">Add Project</button>
        </form>

        <hr>
        <h3>🗑️ Manage Projects</h3>
        <ul class="project-list">
            <?php foreach ($projects as $p): ?>
                <li>
                    <?php echo htmlspecialchars($p['title']); ?>
                    <a href="edit.php?id=<?php echo $p['id']; ?>">✏️ Edit</a>
                    <a href="delete.php?id=<?php echo $p['id']; ?>" onclick="return confirm('Delete <?php echo addslashes($p['title']); ?>?')">🗑️ Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>

        <a href="logout.php" class="logout-btn">🚪 Logout</a>
    </div>
</body>

</html>