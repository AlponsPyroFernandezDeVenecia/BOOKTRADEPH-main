<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Password is correct, start the session
                session_start();
                $_SESSION['user_id'] = $user['id'];
                echo "Login successful!";
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that username.";
        }

        $stmt->close();
    } else {
        echo "Username and password must be provided.";
    }
}

$conn->close();
?>
