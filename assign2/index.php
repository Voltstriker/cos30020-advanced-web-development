<?php
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
                        <div class="brand">
                            <span class="brand-image"></span>
                            <span class="brand-title">RazorBook</span>
                        </div>
                        <ul class="nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                        </ul>
                        <div class="user">
                            <span>Jayden Earles | <a class="btn btn-primary" href="#">Logout</a></span>
                        </div>
                    </nav>
                    <div class="col-12 banner">
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
                    <main class="col-12">
                        <div class="row site-content">
                            <?php
                            // Connect to the database
                            $db_connection = @mysqli_connect($hostname, $username, $password)
                                or die("<p class='text-failure'>Unable to connect to the database server.</p>"
                                    . "<p class='text-failure'>Error code " . mysqli_connect_errno()
                                    . ": " . mysqli_connect_error()) . "</p>";

                            // Select the database
                            if (!@mysqli_select_db($db_connection, $database)) {
                                die("<p class='text-failure'>Unable to locate the '$database' database within the server.</p>");
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

                            // If any required tables are missing, display an error message
                            // Afterwards, create the tables
                            if (!empty($missing_tables)) {
                                echo "<p class='text-error'>The following required tables are missing from the database: \""
                                    . implode('", "', $missing_tables) . "\". Attempting to create the missing tables...</p><ul>";

                                // Create the missing tables
                                foreach ($missing_tables as $table) {
                                    if ($table == 'friends') {
                                        $create_query = "CREATE TABLE friends (
                                            `friend_id` INT NOT NULL AUTO_INCREMENT,
                                            `friend_email` VARCHAR(50) NOT NULL,
                                            `password` VARCHAR(20) NOT NULL,
                                            `profile_name` VARCHAR(30) NOT NULL,
                                            `date_started` DATE NOT NULL,
                                            `num_of_friends` INT UNSIGNED NOT NULL DEFAULT 0,
                                            CONSTRAINT PK_Friends PRIMARY KEY (friend_id),
                                            CONSTRAINT UQ_Friends_Email UNIQUE (friend_email)
                                        )";
                                        $data_query = "INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends)
                                            VALUES ('john.doe@example.com', 'password123', 'John Doe', '2025-01-01', 5),
                                            ('jane.smith@example.com', 'securepass', 'Jane Smith', '2025-02-01', 8),
                                            ('alice.jones@example.com', 'alice123', 'Alice Jones', '2025-03-01', 3),
                                            ('bob.brown@example.com', 'bobsecure', 'Bob Brown', '2025-04-01', 7),
                                            ('charlie.white@example.com', 'charliepass', 'Charlie White', '2025-05-01', 6),
                                            ('david.green@example.com', 'david123', 'David Green', '2025-06-01', 4),
                                            ('emma.black@example.com', 'emmapass', 'Emma Black', '2025-07-01', 9),
                                            ('frank.gray@example.com', 'franksecure', 'Frank Gray', '2025-08-01', 2),
                                            ('grace.blue@example.com', 'grace123', 'Grace Blue', '2025-09-01', 10),
                                            ('hannah.red@example.com', 'hannahpass', 'Hannah Red', '2025-10-01', 1);
                                        ";
                                    } elseif ($table == 'myfriends') {
                                        $create_query = "CREATE TABLE myfriends (
                                            friend_id1 INT NOT NULL,
                                            friend_id2 INT NOT NULL,
                                            CONSTRAINT PK_MyFriends PRIMARY KEY (friend_id1, friend_id2),
                                            CONSTRAINT FK_MyFriends_Friend1 FOREIGN KEY (friend_id1) REFERENCES friends(friend_id),
                                            CONSTRAINT FK_MyFriends_Friend2 FOREIGN KEY (friend_id2) REFERENCES friends(friend_id)
                                        )";
                                        $data_query = "INSERT INTO myfriends (friend_id1, friend_id2)
                                            VALUES (1, 2), (1, 3), (1, 4), (2, 5), (2, 6), (3, 7), (3, 8), (4, 9), (4, 10), (5, 1),
                                            (6, 2), (7, 3), (8, 4), (9, 5), (10, 6), (1, 7), (2, 8), (3, 9), (4, 5), (5, 2);";
                                    }

                                    // Execute the create table query
                                    if (mysqli_query($db_connection, $create_query)) {
                                        echo "<li class='text-success'>Table '$table' created successfully.</li>";
                                    } else {
                                        die("<li class='text-error'>Error creating table '$table': " . mysqli_error($db_connection) . "</li>");
                                    }

                                    // Execute the data insertion query
                                    if (mysqli_query($db_connection, $data_query)) {
                                        echo "<li class='text-success'>Initial data inserted into '$table' successfully.</li>";
                                    } else {
                                        die("<li class='text-error'>Error inserting data into table '$table': " . mysqli_error($db_connection) . "</li>");
                                    }
                                }

                                echo "</ul>";
                            }

                            // Close the database connection
                            mysqli_free_result($result);
                            mysqli_close($db_connection);
                            ?>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>