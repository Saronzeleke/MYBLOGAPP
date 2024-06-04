<?php
// Start session
require("connection.php");
session_start();

// Check if the logout form is submitted
if (isset($_POST['logout'])) {
    // Destroy session and redirect to login page
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
