<?php
require_once 'auth.php';
if (!isAdminLoggedIn()) {
    header('Location: login.php');
    exit;
}

require_once '../config/db.php';

$message = '';
$projects = [];
$categories = ['General', 'Web App', 'Tool', 'API', 'Design'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $github_url = trim($_POST['github_url'] ?? '');
    $category = $_POST['category'] ?? 'General';
    $image_url = '';

    $upload_dir = '../uploads/';
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

    $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

    if (isset($_FILES['project_image']) && $_FILES['project_image']['error'] === 0) {
        $file = $_FILES['project_image'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        if ($finfo === false) {
            $message = "❌ Failed to read file info.";
        } else {
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
        }
    } else {
        $message = "❌ Please upload an image.";
    }

    if ($image_url && !empty($title) && filter_var($github_url, FILTER_VALIDATE_URL)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO projects (title, description, image_url, github_url, category) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $description ?: 'No description.', $image_url, $github_url, $category]);
            header('Location: dashboard.php?success=1');
            exit;
        } catch (Exception $e) {
            $message = "❌ DB error: " . htmlspecialchars($e->getMessage());
        }
    } elseif (!$message) {
        $message = "❌ Title, image, and GitHub URL required.";
    }
}

try {
    $stmt = $pdo->query("SELECT id, title FROM projects ORDER BY created_at DESC");
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
} catch (Exception $e) {
    $projects = [];
    if (!$message) {
        $message = "⚠️ Load failed: " . htmlspecialchars($e->getMessage());
    }
}

// Detect current section (highlight Projects in admin)
$current_page = basename($_SERVER['PHP_SELF']);
$active_page = in_array($current_page, ['dashboard.php', 'edit.php', 'delete.php']) ? 'projects.php' : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style2.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="../../images/logo-colors.png" alt="Logo" class="sidebar-logo" />
        </div>

        <ul class="sidebar-menu">
            <li>
                <a href="../../dashboard/index.php" class="<?= $current_page === 'index.php' ? 'active' : '' ?>">
                    🏠 <span>Home</span>
                </a>
            </li>
            <li>
                <a href="../../dashboard/projects.php" class="<?= $current_page === 'projects.php' ? 'active' : '' ?>">
                    🏠 <span>Publications</span>
                </a>
            </li>
            <li>
                <a href="../../admin/education.php" class="<?= $current_page === 'education.php' ? 'active' : '' ?>">
                    🏠 <span>Education</span>
                </a>
            </li>
            <li>
                <a href="dashboard.php" class="<?= $active_page === 'dashboard.php' ? 'active' : '' ?>">
                    📊 <span>Projects</span>
                </a>
            </li>

            <li>
                <a href="../../dashboard/message.php" class="<?= $current_page === 'messages.php' ? 'active' : '' ?>">
                    💬 <span>Messages</span>
                </a>
            </li>
            <li>
                <a href="../../index.php" class="<?= $active_page === 'index.php' ? 'active' : '' ?>">
                    📊 <span>Portfolio</span>
                </a>
            </li>

        </ul>

        <button class="sidebar-toggle" id="sidebarToggle">❮</button>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <div class="container">
            <h2>➕ Add New Project</h2>

            <?php if (!empty($message)): ?>
                <p class="<?= strpos($message, '❌') !== false || strpos($message, '⚠️') !== false ? 'error' : 'success' ?>">
                    <?= $message ?>
                </p>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <div>
                    <input type="text" name="title" placeholder="Project Title"
                        value="<?= htmlspecialchars($_POST['title'] ?? '') ?>" required />
                </div>
                <div>
                    <textarea name="description" placeholder="Description (use line breaks)">
<?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                </div>
                <div>
                    <input type="file" name="project_image" accept="image/*" required />
                </div>
                <div>
                    <select name="category">
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= htmlspecialchars($cat) ?>"
                                <?= ($cat === ($category ?? 'General')) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <input type="url" name="github_url" placeholder="GitHub URL"
                        value="<?= htmlspecialchars($_POST['github_url'] ?? '') ?>" required />
                </div>
                <button type="submit">Add Project</button>
            </form>

            <hr>
            <h3>🗑️ Manage Projects</h3>
            <?php if (count($projects) > 0): ?>
                <ul class="project-list">
                    <?php foreach ($projects as $p): ?>
                        <li>
                            <?= htmlspecialchars($p['title']) ?>
                            <a href="edit.php?id=<?= (int)$p['id'] ?>">✏️ Edit</a>
                            <a href="delete.php?id=<?= (int)$p['id'] ?>"
                                onclick="return confirm('Delete <?= addslashes(htmlspecialchars($p['title'])) ?>?')">🗑️ Delete</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No projects found. Add one above!</p>
            <?php endif; ?>

            <a href="logout.php" class="logout-btn">🚪 Logout</a>
        </div>
    </div>

    <!-- Dark Mode Toggle -->
    <button id="darkModeToggle">🌙</button>

    <!-- Scripts -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const darkModeToggle = document.getElementById('darkModeToggle');

        // Sidebar Toggle
        sidebarToggle.addEventListener('click', () => {
            const isCollapsed = sidebar.classList.toggle('collapsed');
            sidebarToggle.textContent = isCollapsed ? '❯' : '❮';
            setTimeout(() => {
                mainContent.style.marginLeft = isCollapsed ? '60px' : '250px';
            }, 300);
        });

        // Responsive behavior
        function handleResize() {
            if (window.innerWidth <= 768) {
                sidebar.classList.add('collapsed');
                sidebarToggle.textContent = '❯';
                mainContent.style.marginLeft = '60px';
            } else {
                sidebar.classList.remove('collapsed');
                sidebarToggle.textContent = '❮';
                mainContent.style.marginLeft = '250px';
            }
        }

        window.addEventListener('resize', handleResize);
        window.addEventListener('load', handleResize);

        // Dark Mode
        if (localStorage.getItem('darkMode') === 'true') {
            document.body.classList.add('dark-mode');
            darkModeToggle.textContent = '☀️';
        }

        darkModeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const isDark = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', isDark);
            darkModeToggle.textContent = isDark ? '☀️' : '🌙';
        });
    </script>
</body>

</html>