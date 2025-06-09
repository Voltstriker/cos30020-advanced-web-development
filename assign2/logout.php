<?php
session_start(); // Start the session

// Set all session variables to an empty string
$_SESSION = array();

// Redirect to the login page
header('Location: index.php');
exit();
