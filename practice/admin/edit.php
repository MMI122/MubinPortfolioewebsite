<?php
require_once 'auth.php';
if (!isAdminLoggedIn()) {
    header('Location: login.php');
    exit;
}

require_once '../config/db.php';
$message = '';
$project = null;
$categories = ['General', 'Web App', 'Tool', 'API', 'Design'];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $project = $stmt->fetch();

    if (!$project) {
        die("Project not found.");
    }
} else {
    die("No ID provided.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $github_url = trim($_POST['github_url']);
    $category = $_POST['category'] ?: 'General';
    $image_url = $_POST['existing_image'];

    $upload_dir = '../uploads/';
    $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

    if (isset($_FILES['project_image']) && $_FILES['project_image']['error'] === 0) {
        $file = $_FILES['project_image'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (in_array($mime_type, $allowed_types)) {
            if (file_exists('../' . $image_url)) {
                unlink('../' . $image_url);
            }
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = 'project_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
            move_uploaded_file($file['tmp_name'], $upload_dir . $filename);
            $image_url = 'uploads/' . $filename;
        }
    }

    $stmt = $pdo->prepare("UPDATE projects SET title=?, description=?, image_url=?, github_url=?, category=? WHERE id=?");
    $stmt->execute([$title, $description, $image_url, $github_url, $category, $id]);

    header('Location: dashboard.php?msg=Project+updated');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit Project</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
</head>

<body>
    <div class="container">
        <h2>✏️ Edit Project</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $project['id']; ?>" />
            <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($project['image_url']); ?>" />

            <input type="text" name="title" value="<?php echo htmlspecialchars($project['title']); ?>" required />
            <textarea name="description" rows="6"><?php echo htmlspecialchars($project['description']); ?></textarea>

            <img src="../<?php echo htmlspecialchars($project['image_url']); ?>" alt="Current" width="200" style="margin: 10px 0;" />
            <input type="file" name="project_image" accept="image/*" />
            <p><small>Leave empty to keep current image</small></p>

            <select name="category">
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat; ?>" <?php echo ($cat === $project['category']) ? 'selected' : ''; ?>>
                        <?php echo $cat; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="url" name="github_url" value="<?php echo htmlspecialchars($project['github_url']); ?>" required />
            <button type="submit">Update</button>
        </form>
        <a href="dashboard.php" class="logout-btn">← Back</a>
    </div>
</body>

</html>