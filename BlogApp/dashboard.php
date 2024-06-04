<?php
// Include database connection file
require("connection.php");
session_start();
// Retrieve blog posts from the database
$query = "SELECT * FROM blog ORDER BY `posted-date` DESC";
$result = mysqli_query($conn, $query);

// Check if there are any posts
if (mysqli_num_rows($result) > 0) {
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $posts = []; // Empty array if no posts found
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="dashboard.css?v=<?php echo time() ?>">
</head>

<body>
    <?php include("header.php"); ?>

    <div class="container">
        <h1 class="latest-title">Latest Blog Posts</h1>
        <div class="blog-wrapper">
        <?php foreach ($posts as $post) : ?>
            <article class="article" onclick="redirectToPost(<?php echo $post['blog-id']; ?>)">
                <h2><?php echo $post['blog-title']; ?></h2>
                <div class="blog-image">
                    <img src="<?php echo $post['blog-image']; ?>" alt="blog image">
                </div>
                <p class="content"><?php echo $post['blog-text']; ?></p>
                <?php
                    // Calculate the number of words in the content
                    $content_words = str_word_count(strip_tags($post['blog-text']));
                    // Estimate reading time (assuming an average reading speed of 225 words per minute)
                    $reading_time_minutes = ceil($content_words / 225);
                ?>
                <div class="author-info">
                    <div class="pic"><img src="<?php echo $post['author-image']; ?>" alt="Author"></div>
                    <p><?php echo $post['author-name']; ?></p>
                    <div class="spacer"></div>
                    <p><?php echo $post['posted-date']; ?> • <?php echo $reading_time_minutes; ?> min read</p>
                </div>

                <div class="article-buttons">
                    <!-- Add buttons for like, share, and save functionalities -->
                    <button class="like-button" type="submit" name="like"> <?php echo $post['like-count']; ?> Like</button>
                    <!-- <button class="share-button" data-post-id="<?php echo $post['blog-id']; ?>"><i class="fas fa-share-alt"></i> Share</button>
                    <button class="save-button" data-post-id="<?php echo $post['blog-id']; ?>"><i class="fas fa-save"></i> Save</button> -->
                </div>
            </article>
        <?php endforeach; ?>
        </div>
       

        <?php if (empty($posts)) : ?>
            <p>No blog posts found.</p>
        <?php endif; ?>
    </div>

    <?php include("footer.php"); ?>

    <script>
        function redirectToPost(postId) {
            window.location.href = 'postdetail.php?post_id=' + postId;
        }
    </script>
</body>

</html>
