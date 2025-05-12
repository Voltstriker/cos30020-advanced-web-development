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
    <h2>Task 1: Retrieve and display records from the table</h2>
    <?php
    // Connect to the database
    require_once './settings.php';
    $conn = @mysqli_connect($host, $user, $pswd, $dbnm, $port);
    if (!$conn) {
        die("<p>The database connection is currently unavailable: " . mysqli_connect_error() . "</p>");
    }

    // Initialise the SQL query
    $sql = "SELECT car_id, make, model, price FROM cars";
    $result = mysqli_query($conn, $sql);

    // Output the results in a table
    echo "<table><tr><th>Car ID</th><th>Make</th><th>Model</th><th>Price</th></tr>";
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["car_id"] . "</td><td>" . $row["make"] . "</td><td>" . $row["model"] . "</td><td>" . $row["price"] . "</td></tr>";
        }
    }
    // If no results are found, display a message
    else {
        echo "<tr><td colspan='5'>No results found..</td></tr>";
    }
    echo "</table>";

    // Close the database connection
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
    <script src="scripts/site.js"></script>
</body>

</html>