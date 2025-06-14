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
                        <div class="brand brand-logo">
                            <img src="images/razor.png" alt="RazorBook Logo" class="brand-image" />
                            <a class="brand-title" href="index.php">RazorBook</a>
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
                                echo ' <a class="btn btn-secondary" href="logout.php">Logout</a>';
                            } else {
                                // Display login and register buttons
                                echo '<span><a class="btn btn-secondary" href="login.php">Login</a> <a class="btn btn-secondary" href="signup.php">Register</a></span>';
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

                                    // Fetch the user's profile_id
                                    $profile_id = $_SESSION['profile_id'];

                                    // Pagination setup
                                    $per_page = 5;
                                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                                    if ($page < 1) $page = 1;

                                    // Count total friends
                                    $sql_count = "SELECT COUNT(*) FROM myfriends WHERE friend_id1 = ?";
                                    $stmt_count = mysqli_prepare($db_connection, $sql_count);
                                    mysqli_stmt_bind_param($stmt_count, "i", $profile_id);
                                    mysqli_stmt_execute($stmt_count);
                                    mysqli_stmt_bind_result($stmt_count, $total_friends);
                                    mysqli_stmt_fetch($stmt_count);
                                    mysqli_stmt_close($stmt_count);

                                    $total_pages = max(1, ceil($total_friends / $per_page));
                                    if ($page > $total_pages) $page = $total_pages;
                                    $offset = ($page - 1) * $per_page;

                                    // Fetch friends with pagination
                                    $sql = "SELECT f.profile_name, f.friend_id
                                            FROM myfriends m
                                            INNER JOIN friends f ON m.friend_id2 = f.friend_id
                                            WHERE m.friend_id1 = ?
                                            ORDER BY f.profile_name ASC
                                            LIMIT ? OFFSET ?";
                                    $stmt = mysqli_prepare($db_connection, $sql);
                                    mysqli_stmt_bind_param($stmt, "iii", $profile_id, $per_page, $offset);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);

                                    // Display the friends in a table
                                    echo '<div></div><table id="friend-table">';
                                    echo '<thead><tr><th>Friend Name</th><th>Action</th></tr></thead>';
                                    echo '<tbody>';

                                    // Check if the query was successful and if there are any friends
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        echo '<p>You have <span class="text-bold text-highlight">' . $total_friends . '</span> friend(s).</p>';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $friend_name = htmlspecialchars($row['profile_name']);
                                            $friend_id2 = urlencode($row['friend_id']);
                                            echo '<tr>';
                                            echo '<td>' . $friend_name . '</td>';
                                            echo '<td class="text-center"><a class="btn btn-primary" href="functions/unfriend.php?friend_id=' . $friend_id2 . '">Unfriend</a></td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<td>You have no friends yet.</td><td><a class="btn btn-primary" href="friendadd.php">Add some!</a></td>';
                                    }
                                    echo '</tbody>';
                                    echo '</table>';

                                    // Pagination controls
                                    if ($total_pages > 1) {
                                        echo '<div class="pagination-nav" style="margin-top:1em;"><ul class="pagination">';
                                        // Previous button
                                        if ($page > 1) {
                                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">&laquo; Previous</a></li>';
                                        } else {
                                            echo '<li class="page-item disabled"><span class="page-link">&laquo; Previous</span></li>';
                                        }
                                        // Page numbers
                                        for ($i = 1; $i <= $total_pages; $i++) {
                                            if ($i == $page) {
                                                echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                                            } else {
                                                echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                                            }
                                        }
                                        // Next button
                                        if ($page < $total_pages) {
                                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next &raquo;</a></li>';
                                        } else {
                                            echo '<li class="page-item disabled"><span class="page-link">Next &raquo;</span></li>';
                                        }
                                        echo '</ul></div>';
                                    }
                                    echo '</div>';
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

</html>