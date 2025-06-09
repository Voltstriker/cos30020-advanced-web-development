<?php
// Import the MySQL connection details
require_once 'config.inc.php';

// Start the session
session_start();

// Initialize an array to hold warning messages
$warnings = [];

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $passwordConfirm = $_POST['password-confirm'] ?? '';

    // Check if the username was submitted
    if (empty($username)) {
        $warnings[] = 'Username is required.';
    }
    // Check if the username contains only letters
    elseif (!preg_match('/^[a-zA-Z]+$/', $username)) {
        $warnings[] = 'Username may only contain letters.';
    }

    // Check if the username was submitted
    if (empty($email)) {
        $warnings[] = 'Email address is required.';
    }
    // Check if the email address is valid
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $warnings[] = 'Invalid email address format.';
    }
    // Check if the username already exists in the database
    else {
        $query = "SELECT * FROM friends WHERE friend_email = '$email'";
        $result = mysqli_query($db_connection, $query);
        // If records exist, add a warning
        if (mysqli_num_rows($result) > 0) {
            $warnings[] = 'Email address is already registered.';
        }
        mysqli_free_result($result);
    }

    // Check if the password is populated
    if (empty($password)) {
        $warnings[] = 'Password is required.';
    }
    // Check if password contains only leters and numbers
    elseif (!preg_match('/^[a-zA-Z0-9]+$/', $password)) {
        $warnings[] = 'Password may only contain letters and numbers.';
    }
    // Check if the password inputs match
    elseif ($password !== $passwordConfirm) {
        $warnings[] = 'Passwords do not match.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Assignment 3: System development project 2" />
    <meta name="keywords" content="Web,programming" />
    <meta name="author" content="Jayden Earles" />
    <title>Sign Up | Assignment 3: System development project 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="site.css" />
</head>

<body>
    <div class="container-fluid wrapper">
        <div class="row">
            <div class="container wrapper-content">
                <div class="row">
                    <nav class="col-12 nav">
                        <div class="brand">
                            <span class="brand-image"></span>
                            <span class="brand-title">RazorBook</span>
                        </div>
                        <ul class="nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        </ul>
                        <div class="user">
                            <span><a class="btn btn-primary" href="signup.php">Login</a> | <a class="btn btn-secondary" href="signup.php">Register</a></span>
                        </div>
                    </nav>
                    <div class="col-12 banner banner-warning <?php if (empty($warnings)) echo 'display-none' ?>">
                        <div class="row">
                            <div class="col col-12">
                                <h4>There were some issues when submitting the registration form:</h4>
                                <?php
                                // Display warning messages if any
                                if (!empty($warnings)) {
                                    echo '<ul class="warning-list">';
                                    foreach ($warnings as $warning) {
                                        echo '<li>' . htmlspecialchars($warning) . '</li>';
                                    }
                                    echo '</ul>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <main class="site-content">
                        <div class="container panel">
                            <div class="row">
                                <div class="col col-12">
                                    <form action="signup.php" method="post" enctype="application/x-www-form-urlencoded">
                                        <fieldset class="form-group">
                                            <legend class="form-legend">Register an Account</legend>
                                            <p class="form-text">Please fill in the form below to create a new account.</p>

                                            <div class="input-group">
                                                <label for="username">Username</label>
                                                <input type="text" id="username" name="username" placeholder="Username" required autofocus>
                                            </div>
                                            <div class="input-group">
                                                <label for="email">Email address</label>
                                                <input type="email" id="email" name="email" placeholder="Email Address" required>
                                            </div>
                                            <div class="input-group">
                                                <label for="password">Password</label>
                                                <input type="password" id="password" name="password" placeholder="Password" required>
                                            </div>
                                            <div class="input-group">
                                                <label for="password">Confirm Password</label>
                                                <input type="password" id="password-confirm" name="password-confirm" placeholder="Confirm Password" required>
                                            </div>

                                            <button class="btn btn-primary" type="submit">Sign Up</button>
                                            <button class="btn btn-secondary" type="reset">Reset</button>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>