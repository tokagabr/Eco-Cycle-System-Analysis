<?php
// Database configuration for XAMPP
$host = "localhost";
$user = "root";
$pass = "";  // Default XAMPP password is empty
$db = "Signup";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to ensure proper encoding
$conn->set_charset("utf8mb4");
?>