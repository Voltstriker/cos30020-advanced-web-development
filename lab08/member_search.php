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
    <a class="btn btn-primary" href="member_add_form.php">Add Another Member</a>
    <a class="btn btn-secondary" href="member_display.php">Display All Members</a>
    <br><br>
    <form action="member_search.php" method="get">
        <p class="text-failure"><em>* Items marked with an asterix are mandatory</em></p>
        <fieldset>
            <legend>Enter the details of the VIP member to search:</legend>

            <div class="form-group">
                <label for="lastname">Last Name: <span class="text-failure">*</span></label>
                <input type="text" id="lastname" name="lastname" required /><br /><br />
            </div>
        </fieldset>
        <input class="btn btn-primary" type="submit" value="Search" />
        <input class="btn btn-secondary" type="reset" value="Reset" />
    </form>
    <br><br>
    <?php
    // Check if the form was submitted
    if (isset($_GET['lastname'])) {
        echo "<h3>Search Results:</h3>";
        echo "<p>Searching for members with the last name: <strong>" . htmlspecialchars($_GET['lastname']) . "</strong></p>";

        // Get the last name from the form
        $lastname = htmlspecialchars($_GET['lastname']);

        // Connect to the database
        require_once './settings.php';
        $conn = @mysqli_connect($host, $user, $pswd, $dbnm, $port);
        if (!$conn) {
            die("<p>The database connection is currently unavailable: " . mysqli_connect_error() . "</p>");
        }

        // Initialise the SQL query
        $sql = "SELECT member_id, fname, lname, email FROM vipmembers WHERE lname LIKE '%$lastname%'";
        $result = mysqli_query($conn, $sql);

        // Output the results in a table
        echo "<table><tr><th>Member ID</th><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["member_id"] . "</td><td>" . $row["fname"] . "</td><td>" . $row["lname"] . "</td><td>" . $row["email"] . "</td></tr>";
            }
        }
        // If no results are found, display a message
        else {
            echo "<tr><td colspan='4'>No results found..</td></tr>";
        }
        echo "</table>";

        // Close the database connection
        mysqli_free_result($result);
        mysqli_close($conn);
    }
    ?>

    <script src="scripts/site.js"></script>
</body>

</html>