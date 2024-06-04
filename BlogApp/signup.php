<?php
// Include database connection file
require("connection.php");

// Initialize a variable to hold the signup message
$signupMessage = "";

// Check if the signup form is submitted
if (isset($_POST['signup'])) {
    // Get form data
    $first_name = $_POST['first-name'];
    $middle_name = $_POST['middle-name'];
    $last_name = $_POST['last-name'];
    $username = $_POST['username'];
    $birthdate = $_POST['birthdate'];
    $birthplace = $_POST['birthplace'];
    $gender = $_POST['gender'];
    $education = $_POST['education'];
    $password = $_POST['password'];

    // Check if an image is uploaded
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file path
        $tmpFilePath = $_FILES['photo']['tmp_name'];

        // Extract the file extension
        $fileExtension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

        // Generate a unique file name with extension
        $uploadFileName = uniqid() . '.' . $fileExtension;

        // Move the file to a permanent location
        $uploadDir = 'uploads/'; // Change this to your desired upload directory
        $uploadpath = $uploadDir . $uploadFileName;

        // Check file extension and size for additional security
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        if (in_array($fileExtension, $allowedExtensions) && $_FILES['photo']['size'] <= $maxFileSize) {
            if (move_uploaded_file($tmpFilePath, $uploadpath)) {
                // File upload successful, insert user data into the database

                // Prepare and execute SQL query
                $qry = "INSERT INTO users (first_name, middle_name, last_name, username, birthdate, birthplace, gender, education, password, photo) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($qry);
                $stmt->bind_param("ssssssssss", $first_name, $middle_name, $last_name, $username, $birthdate, $birthplace, $gender, $education, $password, $uploadpath);

                if ($stmt->execute()) {
                    $signupMessage = "Registration successful";
                    header("Location: login.php");
                } else {
                    $signupMessage = "Registration failed";
                }
            } else {
                // File upload failed
                $signupMessage = "Failed to upload image.";
            }
        } else {
            // Invalid file format or size
            $signupMessage = "Invalid file format or size. Allowed formats: JPG, JPEG, PNG, GIF. Maximum file size: 5MB.";
        }
    } else {
        // No image uploaded or an error occurred during upload
        // Insert data into the database without the image path
        $qry = "INSERT INTO users (first_name, middle_name, last_name, username, birthdate, birthplace, gender, education, password) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($qry);
        $stmt->bind_param("sssssssss", $first_name, $middle_name, $last_name, $username, $birthdate, $birthplace, $gender, $education, $password);

        if ($stmt->execute()) {
            $signupMessage = "Registration successful";
        } else {
            $signupMessage = "Registration failed";
        }
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
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="signupin.css?v=<?php echo time() ?>">
</head>

<body>
    <div class="container">
        <h2>Signup</h2>
        <div id="signupMessage"><?php echo $signupMessage; ?></div> <!-- Display signup message -->
        <form id="signupForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validateSignup()">
            <div class="form-group">
                <label for="first-name">First Name:</label>
                <input type="text" id="first-name" name="first-name" required>
            </div>
            <div class="form-group">
                <label for="middle-name">Middle Name:</label>
                <input type="text" id="middle-name" name="middle-name">
            </div>
            <div class="form-group">
                <label for="last-name">Last Name:</label>
                <input type="text" id="last-name" name="last-name" required>
            </div>
            <div class="form-group">
                <label for="username">User Name:</label>
                <input type="text" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="birthdate">Birthdate:</label>
                <input type="date" id="birthdate" name="birthdate" required>
            </div>
            <div class="form-group">
                <label for="birthplace">Birthplace:</label>
                <input type="text" id="birthplace" name="birthplace" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="education">Education:</label>
                <input type="text" id="education" name="education">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="photo">Profile Photo:</label>
                <input type="file" id="photo" name="photo" accept="image/*">
            </div>
            <div class="form-group">
                <input type="submit" value="Signup" name="signup"> <!-- Add name="signup" to submit button -->
            </div>
        </form>
        <div class="switch">
            <p>Already have an account? <a href="index.php">Login</a></p>
        </div>
    </div>

    <script>
        function validateSignup() {
            var firstName = document.getElementById('first-name').value;
            var lastName = document.getElementById('last-name').value;
            var username = document.getElementById('username').value;
            var birthdate = document.getElementById('birthdate').value;
            var birthplace = document.getElementById('birthplace').value;
            var gender = document.getElementById('gender').value;
            var password = document.getElementById('password').value;

            // Check if any required field is empty
            if (firstName === "") {
                document.getElementById('signupMessage').innerHTML = "Please enter your first name.";
                return false;
            }
            if (lastName === "") {
                document.getElementById('signupMessage').innerHTML = "Please enter your last name.";
                return false;
            }
            if (username === "") {
                document.getElementById('signupMessage').innerHTML = "Please enter a username.";
                return false;
            }
            if (birthdate === "") {
                document.getElementById('signupMessage').innerHTML = "Please enter your birthdate.";
                return false;
            }
            if (birthplace === "") {
                document.getElementById('signupMessage').innerHTML = "Please enter your birthplace.";
                return false;
            }
            if (gender === "") {
                document.getElementById('signupMessage').innerHTML = "Please select your gender.";
                return false;
            }
            if (password === "") {
                document.getElementById('signupMessage').innerHTML = "Please enter a password.";
                return false;
            }

            // Validate birthdate format
            var birthdatePattern = /^\d{4}-\d{2}-\d{2}$/;
            if (!birthdatePattern.test(birthdate)) {
                document.getElementById('signupMessage').innerHTML = "Invalid birthdate format. Please use YYYY-MM-DD.";
                return false;
            }

            // Clear any previous error messages if all validations pass
            document.getElementById('signupMessage').innerHTML = "";

            return true;
        }
    </script>
</body>

</html>
