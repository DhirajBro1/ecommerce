<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Default MySQL username in XAMPP
$password = ""; // No password by default
$dbname = "ecommerce_db"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
