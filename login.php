<?php
session_start();
if(isset($_POST['login_submit'])) {
    // Include database connection
    include_once("includes/db.php");

    // Get form data
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    // Query to check user credentials
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['user_password'])) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['type'] = $row['type']; // Store user type in session
            // Check user type and redirect to the appropriate dashboard
            if ($row['type'] == 1) {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: dashboard.php");
            }
            exit;
        } else {
            // Password is incorrect
            echo "Incorrect password";
        }
    } else {
        // User not found
        echo "User not found";
    }
}
?>