<?php
$host = "localhost:4308";
$user = "root";        // Change if needed
$pass = "";            // Change if needed
$db   = "education";

$con_mysqli = new mysqli($host, $user, $pass, $db);

if ($con_mysqli->connect_error) {
    die("Connection failed: " . $con_mysqli->connect_error);
}
