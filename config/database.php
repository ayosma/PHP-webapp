<?php
// config/database.php
$db_host = 'localhost';
$db_user = 'root';  // Replace with your MySQL username
$db_pass = 'Sunfighter1!';  // Replace with your MySQL password
$db_name = 'mywebapp';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}