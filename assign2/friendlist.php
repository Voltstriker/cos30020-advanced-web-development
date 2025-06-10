<?php
// Start the session
session_start();

// Check if the user is already logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false) {
    // Redirect to the home page if already logged in
    header('Location: login.php');
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Assignment 3: System development project 2" />
    <meta name="keywords" content="Web,programming" />
    <meta name="author" content="Jayden Earles" />
    <title>Friend List | Assignment 3: System development project 2</title>
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
                                echo '<li class="nav-item"><a class="nav-link active" href="friendlist.php">Friend List</a></li>';
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
                                echo ' | <a class="btn btn-secondary" href="logout.php">Logout</a>';
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
                                    <h2>Friend List</h2>
                                    <?php
                                    // Display welcome message
                                    echo '<p>Welcome, ' . htmlspecialchars($_SESSION['profile_name']) . '! Here is your friend list:</p>';

                                    // Fetch and display the user's friends from the database
                                    $email = $_SESSION['email'];
                                    $query = "SELECT * FROM myfriends INNER JOIN friends ON myfriends.friend_id1 = friends.friend_id WHERE friends.friend_email = '$email'";
                                    $result = mysqli_query($db_connection, $query);

                                    // Display the friends in a table
                                    echo '<table class="friend-table">';
                                    echo '<thead><tr><th>Friend Name</th>' . '<th>Action</th>' . '</tr></thead>';
                                    echo '<tbody>';

                                    // Check if the query was successful and if there are any friends
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        echo '<p>You have <span class="text-bold">' . mysqli_num_rows($result) . '</span> friend(s).</p>';

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $query = "SELECT profile_name FROM friends WHERE friend_id = " . $row['friend_id2'] . " ORDER BY profile_name";
                                            $friend_result = mysqli_fetch_assoc(mysqli_query($db_connection, $query));
                                            $friend_name = htmlspecialchars($friend_result['profile_name']);
                                            $friend_id2 = urlencode($row['friend_id2']);
                                            echo '<tr>';
                                            echo '<td>' . $friend_name . '</td>';
                                            echo '<td><a class="btn btn-primary" href="functions/unfriend.php?friend_id=' . $friend_id2 . '">Unfriend</a></td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<td>You have no friends yet.</td><td><a class="btn btn-primary" href="friendadd.php">Add some!</a></td>';
                                    }
                                    echo '</tbody>';
                                    echo '</table>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>