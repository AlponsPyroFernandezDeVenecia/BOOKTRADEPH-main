<?php
$servername = "localhost"; // usually localhost
$username = "example_user"; // your DB username
$password = "password123"; // your DB password
$dbname = "login"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
