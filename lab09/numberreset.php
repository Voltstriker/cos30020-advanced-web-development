<?php
// Reset the value of the number in the session
// and redirect to the number page
session_start();
session_unset();
header("location:number.php");
