<?php
session_start();
// Decrease the number in the session variable
if (isset($_SESSION['number'])) {
    $num = $_SESSION['number'];
} else {
    $num = 0;
}
$num--;
$_SESSION['number'] = $num;

// Redirect to the number page
header("location:number.php");
