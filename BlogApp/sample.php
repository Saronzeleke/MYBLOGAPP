<?php
// Include database connection file
require("connection.php");

// Initialize variables
$postMessage = "";
$title = $image = $content = "";
$author_name = $author_image = "";
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post'])) {
    // Get form data
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);


    // Check if an image is uploaded
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file path
        $tmpFilePath = $_FILES['photo']['tmp_name'];
        
        // Move the file to a permanent location
        $uploadDir = 'uploads/'; // Change this to your desired upload directory
        $uploadpath = $uploadDir . basename($_FILES['photo']['name']);
        
        // Check file extension and size for additional security
        $imageFileType = strtolower(pathinfo($uploadpath, PATHINFO_EXTENSION));
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        
        if (in_array($imageFileType, $allowedExtensions) && $_FILES['photo']['size'] <= $maxFileSize) {
            if (move_uploaded_file($tmpFilePath, $uploadpath)) {
                // File upload successful, insert user data into the database

                // Get author info from session
                $author_id = $_SESSION['user_id']; 
                $author_name = $_SESSION['firstName'];
                $author_image = $_SESSION['authorImg']

                $posted_date = date("Y-m-d");
                $posted_time = date("H:i:s");

                // Prepare and execute SQL query
                $qry = "INSERT INTO `blog` (`blog-title`, `blog-image`, `blog-text`, `author-id`, `author-name`, `author-image`, `posted-date`, `posted-time`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                
                $stmt = $conn->prepare($qry);
                $stmt->bind_param("ssssssss", $title, $uploadpath, $content, $author_id, $author_name, $author_image, $posted_date, $posted_time);

                if ($stmt->execute()) {
                    $postMessage = "Blog posted successfully!";
                    header("Location: dashboard.php");
                } else {
                    echo "Failed to post the blog: " . $conn->error;
                }
            } else {
                // File upload failed
                $postMessage = "Failed to upload image.";
            }
        } else {
            // Invalid file format or size
            $postMessage = "Invalid file format or size. Allowed formats: JPG, JPEG, PNG, GIF. Maximum file size: 5MB.";
        }
    } else {
        // No image uploaded or an error occurred during upload
        // Insert data into the database without the image path
        $qry = "INSERT INTO `blog` (`blog-title`, `blog-image`, `blog-text`, `author-id`, `author-name`, `author-image`, `posted-date`, `posted-time`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ssssssss", $title, $uploadpath, $content, $author_id, $author_name, $author_image, $posted_date, $posted_time);

        if ($stmt->execute()) {
            $postMessage = "Blog posted successfully";
        } else {
            echo "Failed to post the blog: " . $conn->error;
    }
}
// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Blog</title>
    <link rel="stylesheet" type="text/css" href="post.css?v=<?php echo time() ?>">
</head>

<body>
    <?php include("header.php"); ?>
    <div class="container">
        <h2>Post Blog</h2>
        <div id="postMessage"><?php echo $postMessage; ?></div> <!-- Display post message -->
        <form id="postForm" action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="image">Image (optional)</label>
                <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                <label for="image" class="add-image">Add image</label>
                <img id="image-preview" src="#" alt="Preview" style="display: none; max-width: 100%; height: auto;">
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" rows="14" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Post Blog" name="post" class="submit"> <!-- Add name="post" to submit button -->
            </div>
        </form>
    </div>

    <?php include("footer.php"); ?>

    <script>
        // Function to preview the selected image
        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById('image-preview');
            var addImageLabel = document.querySelector('.add-image');
            
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    addImageLabel.style.display = 'none'; // Hide the "Add image" label when an image is selected
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.style.display = 'none'; // Hide the preview if no file is selected
                addImageLabel.style.display = 'block'; // Show the "Add image" label if no file is selected
            }
        }
    </script>
</body>

</html>
