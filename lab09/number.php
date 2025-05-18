<?php
session_start();
if (isset($_SESSION['number'])) {
    $num = $_SESSION['number'];
} else {
    $num = 0;
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
    <h2>Task 1: Up and down counter using session</h2>
    <?php
    echo "<p>Current number is: " . $num . "</p>";
    ?>
    <br>
    <a class="btn btn-primary" href="numberup.php">Up</a>
    <a class="btn btn-secondary" href="numberdown.php">Down</a>
    <a class="btn btn-tertiary" href="numberreset.php">Reset</a>
    <script src="scripts/site.js"></script>
</body>

</html>