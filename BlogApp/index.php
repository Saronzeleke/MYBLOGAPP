<?php
    session_start();

    // Redirect to login page if not logged in
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    // If logged in, redirect to dashboard or homepage
    header("Location: dashboard.php"); // Change to the appropriate page
    exit();
?>
