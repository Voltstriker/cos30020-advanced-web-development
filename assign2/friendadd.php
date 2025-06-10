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
    <title>Add Friends | Assignment 3: System development project 2</title>
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
                                echo '<li class="nav-item"><a class="nav-link active" href="friendadd.php">Add Friends</a></li>';
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
                                    <h2>Friend List</h2>
                                    <?php
                                    // Display welcome message
                                    echo '<p>Welcome, ' . htmlspecialchars($_SESSION['profile_name']) . '! Here is a list of users you may add as a friend:</p>';

                                    // Fetch the user's friends from the database
                                    $email = $_SESSION['email'];
                                    $profile_id = $_SESSION['profile_id'];

                                    // Get all friend IDs that the user is already friends with
                                    $user_friends = [];
                                    $friend_query = "SELECT friend_id2 FROM myfriends WHERE friend_id1 = ?";
                                    $stmt = mysqli_prepare($db_connection, $friend_query);
                                    mysqli_stmt_bind_param($stmt, "i", $profile_id);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $friend_id2);
                                    while (mysqli_stmt_fetch($stmt)) {
                                        $user_friends[] = $friend_id2;
                                    }
                                    mysqli_stmt_close($stmt);

                                    // Prepare a string of friend IDs for exclusion
                                    $exclude_ids = $user_friends;
                                    $exclude_ids[] = $profile_id; // Exclude self
                                    $placeholders = implode(',', array_fill(0, count($exclude_ids), '?'));

                                    // Fetch users who are not already friends and not the current user
                                    $sql = "SELECT friend_id, profile_name FROM friends WHERE friend_id NOT IN ($placeholders)";
                                    $stmt = mysqli_prepare($db_connection, $sql);

                                    // Dynamically bind parameters
                                    $types = str_repeat('i', count($exclude_ids));
                                    mysqli_stmt_bind_param($stmt, $types, ...$exclude_ids);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);

                                    // Display the potential friends in a table
                                    echo '<table class="friend-table">';
                                    echo '<thead><tr><th>Friend Name</th>' . '<th>Action</th>' . '</tr></thead>';
                                    echo '<tbody>';

                                    // Check if the query was successful and if there are any potential friends
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        echo '<p>You have <span class="text-bold">' . mysqli_num_rows($result) . '</span> potential friend(s).</p>';
                                        // Loop through the results and display each potential friend
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $friend_name = htmlspecialchars($row['profile_name']);
                                            $friend_id = urlencode($row['friend_id']);
                                            echo '<tr>';
                                            echo '<td>' . $friend_name . '</td>';
                                            echo '<td><a class="btn btn-primary" href="functions/addfriend.php?friend_id=' . $friend_id . '">Add Friend</a></td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<td>You are friends with all registered users - you are a social butterfly!';
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