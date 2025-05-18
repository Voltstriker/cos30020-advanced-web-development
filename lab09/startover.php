<?php
// Completely reset the session and redirect to the guessing game
session_start();
session_unset();
header("location:guessinggame.php");
