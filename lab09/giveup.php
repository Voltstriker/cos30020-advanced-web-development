<?php
session_start();
// Check if the random number is set in the session
// If not, set as -1 to indicate no game has been started
if (isset($_SESSION['number'])) {
    $num = $_SESSION['number'];
} else {
    $num = -1;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Lab 9" />
    <meta name="keywords" content="Web,programming" />
    <meta name="author" content="Jayden Earles" />
    <title>Managing State Information</title>

    <link rel="stylesheet" href="./site.css" />
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <h2>Task 2: Creating a simple "Guessing Game"</h2>
    <?php
    // Check if the user has generated a random number in the main game page
    if ($num == -1) {
        echo "<p class='text-failure'>No number was generated. Please start a new game.</p>";
    }
    // Reset the session values so the next game can start
    else {
        echo "<p class='text-warning'>The hidden number was <strong>$num</strong>. Better luck next time!</p>";
        session_destroy();
    }
    ?>
    <br>
    <a class="btn btn-primary" href="guessinggame.php">Play Again</a>

    <script src="scripts/site.js"></script>
</body>

</html>