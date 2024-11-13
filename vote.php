<?php
// submit_vote.php

// Check if the vote data is received via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get candidate ID and user ID from POST data
    $candidate_id = $_POST['candidate_id'];
    $user_id = $_POST['user_id']; // You may need to get this dynamically based on user login

    // Database connection
    $servername = "localhost";
    $username = "root"; // Your database username
    $password = ""; // Your database password
    $dbname = "voting_system"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL query to insert vote into the database
    $stmt = $conn->prepare("INSERT INTO votes (candidate_id, user_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $candidate_id, $user_id);

    // Execute query and check if the vote was successfully inserted
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Vote submitted successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
