<?php
// Start the session
session_start();

// Initialize an array to hold warning messages
$warnings = [];

// Import the MySQL connection details and initialise the connection
require_once 'config.inc.php';
$db_connection = @mysqli_connect($hostname, $username, $password)
    or $warnings = "Unable to connect to the database server. Error code " . mysqli_connect_errno()
    . ": " . mysqli_connect_error();

// Select the database
if (!@mysqli_select_db($db_connection, $database)) {
    $warnings[] = "Unable to select the database: $database.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Assignment 3: System development project 2" />
    <meta name="keywords" content="Web,programming" />
    <meta name="author" content="Jayden Earles" />
    <title>Login | Assignment 3: System development project 2</title>
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
                            <?php
                            // Check if the user is logged in
                            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                                // Display the profile_name and logout link
                                echo '<span class="user-name">' . htmlspecialchars($_SESSION['profile_name']) . '</span>';
                                echo ' | <a class="btn btn-secondary" href="logout.php">Logout</a>';
                            } else {
                                // Display login and register buttons
                                echo '<span><a class="btn btn-primary" href="login.php">Login</a> | <a class="btn btn-secondary" href="signup.php">Register</a></span>';
                            }
                            ?>
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
                                    <form action="login.php" method="post" enctype="application/x-www-form-urlencoded">
                                        <fieldset class="form-group">
                                            <legend class="form-legend">Log In to RazorBook</legend>
                                            <p class="form-text">Please fill in the form below to log in.</p>

                                            <div class="input-group">
                                                <label for="email">Email address</label>
                                                <input type="email" id="email" name="email" placeholder="Email Address" required <?php if (isset($email)) echo 'value="' . htmlspecialchars($email) . '"'; ?>>
                                            </div>
                                            <div class="input-group">
                                                <label for="password">Password</label>
                                                <input type="password" id="password" name="password" placeholder="Password" required>
                                            </div>

                                            <button class="btn btn-primary" type="submit">Log in</button>
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