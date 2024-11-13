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
    $email = $_POST['register-email'];
    $password = $_POST['register-password'];
    
    // Hash password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Prepare and execute the query
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashedPassword);
    
    if ($stmt->execute()) {
        $_SESSION['email'] = $email; // Store email in session
        header("Location: vote.php"); // Redirect to the vote page
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>

<!-- HTML Form for Registration -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <style>
        /* Add your CSS here */
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="register-email">Email:</label>
                <input type="email" id="register-email" name="register-email" required placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label for="register-password">Password:</label>
                <input type="password" id="register-password" name="register-password" required placeholder="Enter your Password">
            </div>
            <button type="submit">Register</button>
        </form>
        <p><a href="login.php">Already have an account? Login here</a></p>
    </div>
</body>
</html>
