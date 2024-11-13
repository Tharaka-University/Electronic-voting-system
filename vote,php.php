<?php
session_start(); // Start session to check login status

// If the user is not logged in, redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// User is logged in, display vote page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vote</title>
    <style>
        /* Add your CSS here */
    </style>
</head>
<body>
    <div class="container">
        <h2>Vote for your candidates</h2>
        
        <div class="candidate-buttons">
            <div class="candidate">
                <button onclick="selectCandidate(1)">Candidate 1: John Doe (President)</button>
            </div>
            <div class="candidate">
                <button onclick="selectCandidate(2)">Candidate 2: Jane Smith (Vice President)</button>
            </div>
            <div class="candidate">
                <button onclick="selectCandidate(3)">Candidate 3: Robert Brown (Secretary)</button>
            </div>
        </div>
        
        <button class="button" onclick="submitVote()">Submit Vote</button>

        <div class="votes-info">
            <p>Votes Submitted: <span id="votes-submitted">0</span></p>
            <p>Total Votes: <span id="total-votes">0</span></p>
        </div>

        <div class="logout">
            <form action="logout.php" method="POST">
                <button class="button" type="submit">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
