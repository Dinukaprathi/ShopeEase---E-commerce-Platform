<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'config.php';

// Get form data safely
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$name || !$email || !$password) {
    die('All fields are required.');
}

// Check if email already exists
$stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "A user with this email already exists.";
    $stmt->close();
    $conn->close();
    exit;
}
$stmt->close();

// Insert new user (password is NOT hashed as per request)
$stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    echo "Signup successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?> 