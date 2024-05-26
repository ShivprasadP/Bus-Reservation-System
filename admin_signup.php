<?php
    session_start(); // Start the session at the beginning of your script

    if(isset($_POST['signup_submit'])) {
        // Include database connection
        include_once("includes/db.php");

        // Get form data
        $name = $_POST['signup_name'];
        $phone = $_POST['signup_phone'];
        $username = $_POST['signup_username'];
        $password = $_POST['signup_password'];
        $type = 1;

        // Check if username already exists
        $check_sql = "SELECT * FROM users WHERE username = '$username'";
        $check_result = $conn->query($check_sql);
        if ($check_result->num_rows > 0) {
            // Username already exists
            $_SESSION['username-error'] = "Username already exists";
            echo "<script>
                    alert('" . $_SESSION['username-error'] . "');
                    window.location.href='add_admin.php';
                  </script>"; 
            unset($_SESSION['username-error']); // Unset the error message after displaying it
            exit;
        }

        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into database
        $sql = "INSERT INTO users (full_name, username, phone_number, user_password, type) VALUES ('$name', '$username', '$phone', '$hashed_password', '$type')";
        if ($conn->query($sql) === TRUE) {
            // User registered successfully
            $_SESSION['registration-success'] = "Successfully registered! Please login to continue.";
            echo "<script>
                    alert('" . $_SESSION['registration-success'] . "');
                    window.location.href='u_login_signup.html';
                  </script>"; 
            unset($_SESSION['username-error']); // Unset the error message after displaying it
            exit;
        } else {
            // Error in registration
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>