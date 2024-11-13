<?php
session_start(); // Start session to handle login

// Database credentials
$servername = "localhost";  // Replace with your database server address
$username = "root";         // Replace with your MySQL username
$password = "";             // Replace with your MySQL password
$dbname = "voting_system";  // The database we created earlier

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];
    
    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // User found, check password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email']; // Store email in session
            header("Location: vote.php"); // Redirect to the vote page
        } else {
            echo "Invalid credentials.";
        }
    } else {
        echo "User not found.";
    }
    
    $stmt->close();
}

$conn->close();
?>

<!-- HTML Form for Login -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <style>
        /* Add your CSS here */
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="login-email">Email:</label>
                <input type="email" id="login-email" name="login-email" required placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label for="login-password">Password:</label>
                <input type="password" id="login-password" name="login-password" required placeholder="Password">
            </div>
            <button type="submit">Login</button>
        </form>
        <p><a href="register.php">Don't have an account? Register here</a></p>
    </div>
</body>
</html>
