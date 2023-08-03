<?php
session_start();

// Check if the user is authenticated and has a session
if (isset($_SESSION['user_id'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Clear the session cookie
    setcookie(session_name(), '', time() - 3600, '/');

    // Redirect to the home page or sign-in page
    header('Location: ../public/index.php');
    exit();
} else {
    // If the user is not authenticated, redirect to the home page or sign-in page
    header('Location: ../public/index.php');
    exit();
}
?>
