<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

// Check if the user is not logged in (userNameDB is not set in the session)
if (!isset($_SESSION["userNameDB"])) {
    // Redirect the user to the login page
    header("Location: login.php");
    exit(); // Terminate script execution
}

// Destroy the current session, effectively logging the user out
session_destroy();

// Redirect the user to the index page after logging out
header("Location: index.php");
exit();
?>
