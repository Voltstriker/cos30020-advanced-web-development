<?php
// Start the session
session_start();

// Check if the user is already logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false) {
    // Redirect to the home page if already logged in
    header('Location: ../login.php');
    exit();
}

// Get the profile_id from the session
$profile_id = $_SESSION['profile_id'];

// Import the MySQL connection details and initialise the connection
require_once '../config.inc.php';
$db_connection = @mysqli_connect($hostname, $username, $password)
    or die("Unable to connect to the database server. Error code " . mysqli_connect_errno()
        . ": " . mysqli_connect_error());

// Select the database
if (!@mysqli_select_db($db_connection, $database)) {
    die("Unable to select the database: $database.");
}

if (isset($_GET['friend_id']) && trim($_GET['friend_id']) !== '') {
    $friend_id2 = trim($_GET['friend_id']);

    // Check if friend_id2 exists in friends table
    $stmt = $db_connection->prepare("SELECT friend_id FROM friends WHERE friend_id = ?");
    $stmt->bind_param("i", $friend_id2);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Insert into myfriends
        $insert = $db_connection->prepare("INSERT INTO myfriends (friend_id1, friend_id2) VALUES (?, ?)");
        $insert->bind_param("ii", $profile_id, $friend_id2);
        $insert->execute();
        $insert->close();
    }
    $stmt->close();
}

// Redirect back to the addfriend.php page after adding the friend
header('Location: ../friendadd.php');
