<?php
session_unset();
session_destroy();
// Redirect to the login page
header('Location: login.php');
exit();
