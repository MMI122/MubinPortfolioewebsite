<?php
// session_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../config/db.php';

function isAdminLoggedIn()
{
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function loginAdmin($username, $password)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT password FROM admin_users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && $user['password'] === $password) {
        $_SESSION['admin_logged_in'] = true;
        return true;
    }
    return false;
}
