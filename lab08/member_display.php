<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Lab 7" />
    <meta name="keywords" content="Web,programming" />
    <meta name="author" content="Jayden Earles" />
    <title>MySQL Databases with PHP</title>

    <link rel="stylesheet" href="./site.css" />
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <h2>Task 2: VIP Member Registration System</h2>

    <h3>List of VIP Members:</h3>

    <?php
    // Connect to the database
    require_once './settings.php';
    $conn = @mysqli_connect($host, $user, $pswd, $dbnm, $port);
    if (!$conn) {
        die("<p>The database connection is currently unavailable: " . mysqli_connect_error() . "</p>");
    }

    // Initialise the SQL query
    $sql = "SELECT member_id, fname, lname FROM vipmembers";
    $result = mysqli_query($conn, $sql);

    // Output the results in a table
    echo "<table><tr><th>Member ID</th><th>First Name</th><th>Last Name</th></tr>";
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["member_id"] . "</td><td>" . $row["fname"] . "</td><td>" . $row["lname"] . "</td></tr>";
        }
    }
    // If no results are found, display a message
    else {
        echo "<tr><td colspan='3'>No results found..</td></tr>";
    }
    echo "</table>";

    // Close the database connection
    mysqli_free_result($result);
    mysqli_close($conn);

    ?>
    <br>
    <a class="btn btn-primary" href="vip_member.php">Back to VIP Member Home</a>
    <a class="btn btn-secondary" href="member_add_form.php">Add New Member</a>

    <script src="scripts/site.js"></script>
</body>

</html>