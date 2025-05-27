<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Lab 10" />
    <meta name="keywords" content="Web,programming" />
    <meta name="author" content="Jayden Earles" />
    <title>Developing Object Oriented PHP</title>

    <link rel="stylesheet" href="./site.css" />
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <h2>Task 2: Creating a simple "Hit Counter"</h2>
    <form method="post" action="setup.php">
        <p class="text-failure"><em>* Items marked with an asterix are mandatory</em></p>
        <fieldset>
            <legend>Enter the database connection details</legend>
            <div class="form-group">
                <label for="guess">Hostname: <span class="text-failure">*</span></label>
                <input type="text" id="hostname" name="hostname" placeholder="feenix-mariadb.swin.edu.au" required>
            </div>
            <div class="form-group">
                <label for="guess">Port: <span class="text-failure">*</span></label>
                <input type="number" id="port" name="port" placeholder="3306" class="short-number" required>
            </div>
            <div class="form-group">
                <label for="guess">Database Name: <span class="text-failure">*</span></label>
                <input type="text" id="dbname" name="dbname" placeholder="s100684019_db" required>
            </div>
            <div class="form-group">
                <label for="guess">Username: <span class="text-failure">*</span></label>
                <input type="text" id="user" name="user" required>
            </div>
            <div class="form-group">
                <label for="guess">Password: <span class="text-failure">*</span></label>
                <input type="password" id="password" name="password" required>
            </div>
        </fieldset>
        <?php
        // Handle the form submission
        if (isset($_POST['hostname']) && isset($_POST['port']) && isset($_POST['dbname']) && isset($_POST['user']) && isset($_POST['password'])) {
            $host = $_POST['hostname'];
            $port = $_POST['port'];
            $dbnm = $_POST['dbname'];
            $user = $_POST['user'];
            $pswd = $_POST['password'];

            // Attempt to connect to the database using the provided credentials
            try {
                // Create a new MySQLi connection
                // Use the provided hostname, port, database name, username, and password
                // Suppress warnings with the '@' operator
                @$conn = new mysqli($host, $user, $pswd, $dbnm, $port);

                // Check if the connection was successful
                if ($conn->connect_error) {
                    throw new Exception("Connection failed: " . $conn->connect_error);
                }
            } catch (Exception $e) {
                // If the connection fails, display an error message
                die("<p class='text-failure'>The database connection is currently unavailable: " . $e->getMessage() . "</p>");
            }

            // Store the connection details in a text file
            // Convert the connection details to a JSON format
            $settingsFile = './data/lab10/mykeys.txt';
            $settings = [
                'hostname' => $host,
                'port' => $port,
                'dbname' => $dbnm,
                'username' => $user,
                'password' => $pswd
            ];

            // Encode the settings as JSON and write to the file
            $jsonSettings = json_encode($settings, JSON_PRETTY_PRINT);
            if (@file_put_contents($settingsFile, $jsonSettings) === false) {
                die("<p class='text-failure'>Failed to write database connection details to file.</p>");
            }

            // Check if the 'hitcounter' table already exists
            // If it doesn't exist, create it
            $checkTableQuery = "SHOW TABLES LIKE 'hitcounter'";
            $result = mysqli_query($conn, $checkTableQuery);
            if (mysqli_num_rows($result) === 0) {
                $sql = "CREATE TABLE IF NOT EXISTS `hitcounter` (
                    id SMALLINT AUTO_INCREMENT PRIMARY KEY,
                    count SMALLINT NOT NULL DEFAULT 0
                )";

                // Execute the query to create the table
                if (mysqli_query($conn, $sql)) {
                    echo "<p class='text-success'>Database setup successful! The 'hitcounter' table has been created.</p>";
                } else {
                    echo "<p class='text-failure'>Error creating table: " . mysqli_error($conn) . "</p>";
                }
            }

            // If the table exists, we can skip the creation step
            // Truncate the table to reset the count
            else {
                $sql = "TRUNCATE TABLE `hitcounter`";
                if (mysqli_query($conn, $sql)) {
                    echo "<p class='text-success'>The 'hitcounter' table already exists and has been reset.</p>";
                } else {
                    echo "<p class='text-failure'>Error truncating table: " . mysqli_error($conn) . "</p>";
                }
            }

            // Create an initial record in the 'hitcounter' table
            $sql = "INSERT INTO `hitcounter` (count) VALUES (0)";
            if (mysqli_query($conn, $sql)) {
                echo "<p class='text-success'>Initial record created in 'hitcounter' table.</p>";
            } else {
                echo "<p class='text-failure'>Error inserting initial record: " . mysqli_error($conn) . "</p>";
            }

            // Close the connection
            $conn->close();
        }
        ?>
        <input class="btn btn-primary" type="submit" value="Setup Database" />
    </form>
    <script src="scripts/site.js"></script>
</body>

</html>