<?php
// Include database connection file
require("connection.php");

// Start session
session_start();


// Initialize a variable to hold the login message
$loginMessage = "";

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Get form data and sanitize inputs
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['password'];

// Prepare and execute SQL query to retrieve user data
$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Check if the user exists
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if ($password == $user['password']) {
            // Password is correct, set session variables and redirect to dashboard or homepage
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['firstName'] = $user['first_name'];
            $_SESSION['authorImg'] = $user['photo'];

            header("Location: dashboard.php");
            exit();
        } else {
            // Password is incorrect, show error message
            $loginMessage = "Invalid username or password.";
        }
    } else {
        // User doesn't exist, show error message
        $loginMessage = "Invalid username or password.";
    }
} else {
    // Query failed, show error message
    $loginMessage = "Error: " . mysqli_error($conn);
}

}

// Check if user is already logged in
if(isset($_SESSION['username'])){
    // Redirect to dashboard
    header("Location: dashboard.php");
    exit();
}

// Check if the logout form is submitted
if (isset($_POST['logout'])) {
    // Destroy session and redirect to login page
    session_destroy();
    header("Location: login.php");
    exit();
}

// Close database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="signupin.css?v=<?php echo time() ?>">
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <div id="loginMessage"><?php echo $loginMessage; ?></div> <!-- Display login message -->
        <form id="loginForm" action="" method="post" onsubmit="return validateLogin()">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="form-group">
                <input type="submit" name="login" value="Login">
            </div>
        </form>

        <div class="switch">
            <p>Don't have an account? <a href="signup.php">Signup</a></p>
        </div>
    </div>

    <script>
        function validateLogin() {
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
            if (username === "" || password === "") {
                document.getElementById('loginMessage').innerHTML = "Please fill in all fields.";
                return false;
            }
            return true;
        }
    </script>
</body>

</html>
