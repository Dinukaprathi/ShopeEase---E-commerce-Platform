<?php
// Database configuration for shopping_cart
$servername = "localhost";
$username = "root";
$password = "Dinukamash@1"; // default for XAMPP
$dbname = "shopping_cart";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?> 