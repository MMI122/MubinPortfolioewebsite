<?php
require_once 'auth.php';
if (!isAdminLoggedIn()) {
    header('Location: login.php');
    exit;
}

require_once '../config/db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("SELECT image_url FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $project = $stmt->fetch();

    if ($project) {
        $image_path = '../' . $project['image_url'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->execute([$id]);
    }
}

$message = "Project deleted.";
header('Location: dashboard.php?msg=' . urlencode($message));
exit;
