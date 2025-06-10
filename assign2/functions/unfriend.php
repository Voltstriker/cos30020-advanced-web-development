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

// Check if friend_id is set and not empty
if (isset($_GET['friend_id']) && trim($_GET['friend_id']) !== '') {
    $friend_id2 = trim($_GET['friend_id']);

    // Delete from myfriends table if it exists
    $delete = $db_connection->prepare("DELETE FROM myfriends WHERE friend_id1 = ? AND friend_id2 = ?");
    $delete->bind_param("ii", $profile_id, $friend_id2);
    $delete->execute();
    $delete->close();
}

// Redirect back to the addfriend.php page after adding the friend
header('Location: ../friendlist.php');
