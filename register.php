<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure all required fields are set
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    // Prepare the SQL statement
    $sql = "INSERT INTO users (first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error)); // Check for errors
    }

    // Bind parameters
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $username, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
