<?php
session_start();
require_once "connection.php"; // Include your database connection file

if (isset($_POST['like'])) {
    $blog_id = $_POST['blog_id'];

    // Update the like count in the database
    $sql = "UPDATE blog SET `like-count` = `like-count` + 1 WHERE `blog-id` = $blog_id";
    echo "SQL Query: " . $sql; // Echo the SQL query for debugging
    if (mysqli_query($conn, $sql)) {
        // Like added successfully
        header("Location: postdetail.php?post_id=$blog_id");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
