<?php
session_start();

// Check if the admin is logged in
if (isset($_SESSION['admin'])) {
    // Unset all session variables
    $_SESSION = [];

    // Destroy the session
    session_destroy();
}

// Redirect to the login page
header("Location: ../login.php");
exit;
?>
