<?php
// Include database connection file
require("connection.php");
session_start();
// Parse the post ID from the URL query parameters
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    // Fetch the like count for the current blog post
    $sql = "SELECT `like-count` FROM blog WHERE `blog-id` =  $post_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $like_count = $row['like-count'];

    // Fetch post details from the database based on the post ID
    $query = "SELECT * FROM `blog` WHERE `blog-id` = $post_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Post found, fetch post details
        $post = mysqli_fetch_assoc($result);

        // Extract post details
        $title = $post['blog-title'];
        $image = $post['blog-image'];
        $content = $post['blog-text'];
        $author_id = $post['author-id'];
        $author_image = $post['author-image'];
        $author_name = $post['author-name'];
        $posted_date = date("F j, Y", strtotime($post['posted-date']));
        $posted_minute = $post['posted-time'];
        $reading_time_minutes = ceil(str_word_count(strip_tags($content)) / 225);

        // You can also fetch author details if needed

    } else {
        // Post not found
        $error_message = "Post not found.";
    }
} else {
    // Post ID not provided in the URL
    $error_message = "Post ID not provided.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Detail</title>
    <link rel="stylesheet" href="postdetail.css?v=<?php echo time() ?>">
</head>

<body>
    <?php include("header.php"); ?>

    <div class="container">
        <?php if (isset($error_message)) : ?>
            <p><?php echo $error_message; ?></p>
        <?php else : ?>
            <div class="detail-wrapper">
                <div class="main">
                    <div class="top">
                        <h1 class="detail-title"><?php echo $title; ?></h1>
                        <h3>1 min read</h3>
                    </div>
                    <div class="hero-image">
                        <img class="detail-title" src="<?php echo $image; ?>" alt="Post Image">
                    </div>
                    
                    <p class="detail-content"><?php echo $content; ?></p>
                </div>
                <aside class="aside">
                    <div class="row">
                        <h3>Posted by</h3>
                        <img class="author-image" src="<?php echo $author_image; ?>" alt="author Image">
                        <p class="author-name"><?php echo $author_name; ?></p>
                    </div>
                    <div class="row">
                        <h3>Posted on </h3>
                        <p><?php echo $posted_date; ?></p>
                        <p><?php echo $posted_minute; ?></p>
                    </div>
                    <div class="row">
                    <form action="like.php" method="post">
                        <p><?php echo $post['like-count']; ?> likes</p>
                        <input type="hidden" name="blog_id" value="<?php echo $post_id; ?>">
                        <button class="like-button" type="submit" name="like">Like</button>
                    </form>

                    </div>
                    
                </aside>

            </div>
           
            
            <!-- Add more details or actions here -->
        <?php endif; ?>
    </div>

    <?php include("footer.php"); ?>
</body>

</html>

<?php
// Close database connection
mysqli_close($conn);
?>
