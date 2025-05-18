<?php
session_start();
if (isset($_SESSION['number'])) {
    $num = $_SESSION['number'];
} else {
    $num = 0;
}
$num--;
$_SESSION['number'] = $num;
header("location:number.php");
