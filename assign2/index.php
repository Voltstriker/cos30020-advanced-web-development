<?php
// Start the session
session_start();

// Import the MySQL connection details
require_once 'config.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Assignment 3: System development project 2" />
    <meta name="keywords" content="Web,programming" />
    <meta name="author" content="Jayden Earles" />
    <title>Assignment 3: System development project 2</title>
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
                            <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
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
                                echo '<span><a class="btn btn-secondary" href="login.php">Login</a> <a class="btn btn-secondary" href="signup.php">Register</a></span>';
                            }
                            ?>
                        </div>
                    </nav>
                    <div class="col-12 banner banner-warning">
                        <h2>Assignment 3: System development project 2</h2>
                        <p>The requirements for this assignment are listed in the <a href="assets/Assignment 3 System development project 2.pdf" target="_blank">worksheet document</a>.</p>
                        <br>
                        <h4>Assignment Details/Disclosure</h4>
                        <p>I declare that this assignment is my individual work. I have not worked collaboratively nor have I copied from any other student's work or from any other source.</p>
                        <p>I have made use of Bootstrap v4's grid system to assist with UI alignment. I make no claim to this code and it is used according to the <a href="https://getbootstrap.com/docs/4.0/about/license/">licensing terms</a>.</p>
                        <ul>
                            <li><strong>Student Name:</strong> Jayden Earles</li>
                            <li><strong>Student ID:</strong> 100684019</li>
                            <li><strong>Email:</strong> <a href="mailto:100684019@student.swin.edu.au" target="_blank">100684019@student.swin.edu.au</a></li>
                        </ul>
                        <p></p>
                    </div>
                    <main class="site-content">
                        <?php
                        // Connect to the database
                        $db_connection = @mysqli_connect($hostname, $username, $password)
                            or die("<p class='text-failure'>Unable to connect to the database server.</p>"
                                . "<p class='text-failure'>Error code " . mysqli_connect_errno()
                                . ": " . mysqli_connect_error()) . "</p>";

                        // Select the database
                        if (!@mysqli_select_db($db_connection, $database)) {
                            $db_connection_error = true;
                        } else {
                            $db_connection_error = false;
                        }

                        // Check if the database tables exist
                        $tables = ['friends', 'myfriends'];
                        $missing_tables = [];
                        foreach ($tables as $table) {
                            $query = "SHOW TABLES LIKE '$table'";
                            $result = mysqli_query($db_connection, $query);
                            if (mysqli_num_rows($result) == 0) {
                                $missing_tables[] = $table;
                            }
                        }
                        ?>

                        <div class="container banner banner-info <?php if (!$db_connection_error && empty($missing_tables)) echo "display-none" ?>">
                            <div class="row">
                                <div class="col col-12">
                                    <?php
                                    // Display an error message if the database connection failed
                                    if ($db_connection_error) {
                                        die("<p class='text-failure'>Unable to locate the '$database' database within the server.</p>");
                                    }

                                    // If any required tables are missing, display an error message
                                    // Afterwards, create the tables
                                    if (!empty($missing_tables)) {
                                        echo "<p class='text-error'>The following required tables are missing from the database: \""
                                            . implode('", "', $missing_tables) . "\". Attempting to create the missing tables...</p><ul>";

                                        // Create the missing tables
                                        foreach ($missing_tables as $table) {
                                            // Create the friends table with dummy data
                                            if ($table == 'friends') {
                                                $create_query = "CREATE TABLE IF NOT EXISTS `friends` (
                                                `friend_id` INT NOT NULL AUTO_INCREMENT,
                                                `friend_email` VARCHAR(50) NOT NULL,
                                                `password` VARCHAR(20) NOT NULL,
                                                `profile_name` VARCHAR(30) NOT NULL,
                                                `date_started` DATE NOT NULL,
                                                `num_of_friends` INT UNSIGNED NOT NULL DEFAULT 0,
                                                CONSTRAINT PK_Friends PRIMARY KEY (friend_id),
                                                CONSTRAINT UQ_Friends_Email UNIQUE (friend_email))";

                                                $data_query = "INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends)
                                                VALUES ('john.doe@gmail.com', 'password123', 'John', '2025-01-01', 5),
                                                ('jane.smith@gmail.com', 'securepass', 'Jane', '2025-02-01', 8),
                                                ('alice.jones@gmail.com', 'alice123', 'Alice', '2025-03-01', 3),
                                                ('bob.brown@gmail.com', 'bobsecure', 'Bob', '2025-04-01', 7),
                                                ('charlie.white@gmail.com', 'charliepass', 'Charlie', '2025-05-01', 6),
                                                ('david.green@gmail.com', 'david123', 'David', '2025-06-01', 4),
                                                ('emma.black@gmail.com', 'emmapass', 'Emma', '2025-07-01', 9),
                                                ('frank.gray@gmail.com', 'franksecure', 'Frank', '2025-08-01', 2),
                                                ('grace.blue@gmail.com', 'grace123', 'Grace', '2025-09-01', 10),
                                                ('hannah.red@gmail.com', 'hannahpass', 'Hannah', '2025-10-01', 1);";
                                            }
                                            // Create the myfriends table with dummy data
                                            elseif ($table == 'myfriends') {
                                                $create_query = "CREATE TABLE IF NOT EXISTS `myfriends` (
                                                friend_id1 INT NOT NULL,
                                                friend_id2 INT NOT NULL,
                                                CONSTRAINT PK_MyFriends PRIMARY KEY (friend_id1, friend_id2),
                                                CONSTRAINT FK_MyFriends_Friend1 FOREIGN KEY (friend_id1) REFERENCES friends(friend_id),
                                                CONSTRAINT FK_MyFriends_Friend2 FOREIGN KEY (friend_id2) REFERENCES friends(friend_id))";

                                                $data_query = "INSERT INTO myfriends (friend_id1, friend_id2)
                                                VALUES (1, 2), (1, 3), (1, 4), (2, 1), (2, 3),
                                                (2, 5), (3, 1), (3, 2), (3, 4), (3, 5),
                                                (4, 1), (4, 3), (4, 5), (4, 6), (5, 2),
                                                (5, 3), (5, 4), (5, 6), (6, 4), (6, 5);";
                                            }

                                            // Execute the create table query
                                            if (mysqli_query($db_connection, $create_query)) {
                                                echo "<li>Table '$table' created successfully.</li>";
                                            } else {
                                                die("<li>Error creating table '$table': " . mysqli_error($db_connection) . "</li>");
                                            }

                                            // Execute the data insertion query
                                            if (mysqli_query($db_connection, $data_query)) {
                                                echo "<li>Initial data inserted into '$table' successfully.</li>";
                                            } else {
                                                die("<li>Error inserting data into table '$table': " . mysqli_error($db_connection) . "</li>");
                                            }
                                        }

                                        echo "</ul>";
                                    }

                                    // Close the database connection
                                    mysqli_free_result($result);
                                    mysqli_close($db_connection);
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="container panel">
                            <div class="row">
                                <div class="col col-12">
                                    <h3>Welcome to RazorBook!</h3>
                                    <p>This is a sample application for the assignment. It demonstrates the use of PHP and MySQL to create a simple social networking platform.</p>
                                    <br>
                                    <h4>User Login</h4>
                                    <p>The navbar will show the currently logged in user - when a user is logged in, the login and sign up links will not display. Log out from the current user to make these links display.</p>
                                    <br>
                                    <h4>Database Management</h4>
                                    <p class="<?php if (isset($_POST['drop_tables'])) echo "display-none" ?>">You can use the button below to drop the tables and reset the database.</p>

                                    <!-- Drop Tables Button -->
                                    <form method="post" action="index.php" onsubmit="return confirm('Are you sure you want to drop the database tables? This action cannot be undone.');" class="<?php if (isset($_POST['drop_tables'])) echo "display-none" ?>">
                                        <button type="submit" name="drop_tables" class="btn btn-danger">Drop Database Tables</button>
                                    </form>
                                    <?php
                                    if (isset($_POST['drop_tables'])) {
                                        $db_connection = @mysqli_connect($hostname, $username, $password, $database)
                                            or die("<p class='text-failure'>Unable to connect to the database server.</p>");
                                        // Drop myfriends first due to FK constraint
                                        $drop_myfriends = "DROP TABLE IF EXISTS myfriends";
                                        $drop_friends = "DROP TABLE IF EXISTS friends";
                                        $success = true;
                                        if (!mysqli_query($db_connection, $drop_myfriends)) {
                                            echo "<p class='text-error'>Failed to drop myfriends: " . mysqli_error($db_connection) . "</p>";
                                            $success = false;
                                        }
                                        if (!mysqli_query($db_connection, $drop_friends)) {
                                            echo "<p class='text-error'>Failed to drop friends: " . mysqli_error($db_connection) . "</p>";
                                            $success = false;
                                        }
                                        if ($success) {
                                            echo "<p>Tables <span class='text-bold text-highlight'>myfriends</span> and <span class='text-bold text-highlight'>friends</span> dropped successfully. Please <a href='index.php'>refresh the page</a> to trigger the recreation of the tables.</p>";
                                        }
                                        mysqli_close($db_connection);
                                    }
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