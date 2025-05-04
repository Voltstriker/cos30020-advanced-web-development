<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Lab 5" />
    <meta name="keywords" content="Web,programming" />
    <title>Files and Directories</title>

    <link rel="stylesheet" href="assets/site.css" />
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <h2>Task 2: Updating the Guest Book System</h2>

    <table>
        <caption>Current Guest Book</caption>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
        </tr>
        <?php
        // Initialise an empty array to store existing data
        $alldata = array();

        // Open the file in read mode
        try {
            $file = @fopen('./data/guestbook.txt', 'r');
            if (!$file) {
                throw new Exception("Unable to locate guestbook.txt file");
            } else {
                if (filesize('./data/guestbook.txt') === 0) {
                    echo "<tr><td colspan='2'>No guests have signed the guestbook</td></tr>";
                    fclose($file);
                    return;
                }

                // Read each line from the file and display it as a table row
                while (!feof($file)) {
                    $line = fgets($file);
                    if ($line) {
                        list($lastname, $firstname, $email) = explode(',', trim($line));
                        $alldata[] = [$firstname, $lastname, $email];
                    }
                }

                // Sort the copy by first name (index 0)
                usort($alldata, function ($a, $b) {
                    // Compare first elements
                    $cmp = strcmp($a[0], $b[0]);
                    if ($cmp !== 0) return $cmp;

                    // Compare second elements
                    $cmp = strcmp($a[1], $b[1]);
                    if ($cmp !== 0) return $cmp;

                    // Compare third elements
                    return strcmp($a[2], $b[2]);
                });

                // Display each guest signature in the table
                foreach ($alldata as $person) {
                    echo "<tr><td>{$person[0]}</td><td>{$person[1]}</td><td>{$person[2]}</td></tr>";
                }

                // Close the file
                fclose($file);
            }
        } catch (Exception $e) {
            echo "<tr><td colspan='2'>" . $e->getMessage() . "</td></tr>";
            $file = false;
        }
        ?>
    </table>
    <script src="assets/site.js"></script>
</body>

</html>