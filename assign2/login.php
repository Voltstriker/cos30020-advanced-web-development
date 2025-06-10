<?php
// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Redirect to the home page if already logged in
    header('Location: index.php');
    exit();
}

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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email and password from the form
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Validate the email and password
    if (empty($email)) {
        $warnings[] = "Email address is required.";
    }
    if (empty($password)) {
        $warnings[] = "Password is required.";
    }

    // If there are no warnings, proceed to check the credentials
    if (empty($warnings)) {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = mysqli_prepare($db_connection, "SELECT friend_id, profile_name FROM friends WHERE friend_email = ? AND password = ?");
        mysqli_stmt_bind_param($stmt, 'ss', $email, $password);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Bind the result to variables
        mysqli_stmt_bind_result($stmt, $profile_id, $profile_name);

        // Fetch the result
        if (mysqli_stmt_fetch($stmt)) {
            // Set session variables and mark user as logged in
            $_SESSION['logged_in'] = true;
            $_SESSION['profile_id'] = $profile_id;
            $_SESSION['profile_name'] = $profile_name;
            $_SESSION['email'] = $email;
            header('Location: friendlist.php');
            exit();
        }
        // Record not found or invalid credentials
        else {
            $warnings[] = "Invalid email or password.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
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
                            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                            <?php
                            // Check if the user is logged in to display the appropriate links
                            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                                echo '<li class="nav-item"><a class="nav-link" href="friendlist.php">Friend List</a></li>';
                                echo '<li class="nav-item"><a class="nav-link" href="friendadd.php">Add Friends</a></li>';
                            }
                            ?>
                        </ul>
                        <div class="user">
                            <?php
                            // Check if the user is logged in
                            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                                // Display the profile_name and logout link
                                echo '<span class="user-name">' . htmlspecialchars($_SESSION['profile_name']) . '</span>';
                                echo ' <a class="btn btn-secondary" href="logout.php">Logout</a>';
                            } else {
                                // Display login and register buttons
                                echo '<span><a class="btn btn-primary" href="login.php">Login</a> <a class="btn btn-secondary" href="signup.php">Register</a></span>';
                            }
                            ?>
                        </div>
                    </nav>

                    <div class="col-12 banner banner-warning <?php if (empty($warnings)) echo 'display-none' ?>">
                        <div class="row">
                            <div class="col col-12">
                                <h4>There were some issues when logging in:</h4>
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