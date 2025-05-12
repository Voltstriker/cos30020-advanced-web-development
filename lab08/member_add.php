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

    <?php
    // Check if the form was submitted
    if (isset($_POST['firstname'], $_POST['lastname'], $_POST['gender'], $_POST['email'], $_POST['phone'])) {
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $gender = htmlspecialchars($_POST['gender']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);

        // Connect to the database
        require_once './settings.php';
        $conn = @mysqli_connect($host, $user, $pswd, $dbnm, $port);
        if (!$conn) {
            die("<p>The database connection is currently unavailable: " . mysqli_connect_error() . "</p>");
        }

        // Check if the "vipmembers" table exists
        // If it doesn't exist, create it using the SQL file
        $tableCheckQuery = "SHOW TABLES LIKE 'vipmembers'";
        $tableCheckResult = mysqli_query($conn, $tableCheckQuery);
        if (mysqli_num_rows($tableCheckResult) === 0) {
            // Table does not exist, execute the SQL file to create it
            $sqlFile = './create_tables.sql';
            if (file_exists($sqlFile)) {
                $sqlCommands = file_get_contents($sqlFile);
                // Execute the SQL commands
                if (mysqli_multi_query($conn, $sqlCommands)) {
                    // Loop through each SQL command in file
                    do {
                        // Flush multi_query results
                        if ($result = mysqli_store_result($conn)) {
                            mysqli_free_result($result);
                        }
                    } while (mysqli_next_result($conn));
                }
                // Handle any errors being returned from the SQL queries
                else {
                    die("<p class='text-failure'>Error executing SQL file: " . mysqli_error($conn) . "</p>");
                }
            } else {
                die("<p class='text-failure'>SQL file not found: $sqlFile</p>");
            }
        }

        // Prepare the SQL statement to insert the new member
        $stmt = mysqli_prepare($conn, "INSERT INTO vipmembers (fname, lname, gender, email, phone) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            // Bind the parameters
            mysqli_stmt_bind_param($stmt, 'sssss', $firstname, $lastname, $gender, $email, $phone);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo "<p class='text-success'>New member added successfully!</p>";
            } else {
                die("<p class='text-failure'>Error adding new member: " . mysqli_error($conn) . "</p>");
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            die("<p class='text-failure'>Error preparing SQL statement: " . mysqli_error($conn) . "</p>");
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        die("<p class='text-failure'>Invalid form submission - please try submitting the <a href='member_add_form.php'>form</a> again.</p>");
    }
    ?>
    <br><br>
    <a class="btn btn-primary" href="member_add_form.php">Add Another Member</a>
    <a class="btn btn-secondary" href="member_display.php">Display All Members</a>
    <script src="scripts/site.js"></script>
</body>

</html>