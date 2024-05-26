<?php
session_start();

// Unset session variables
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['type']);

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: u_login_signup.php");
exit;
?>