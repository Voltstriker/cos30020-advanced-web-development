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
    <h2>Task 2: Creating a Guest Book</h2>

    <table>
        <caption>Current Guest Book</caption>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
        <?php
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
                while (($line = fgets($file)) !== false) {
                    list($lastname, $firstname) = explode(',', trim($line));
                    echo "<tr><td>$firstname</td><td>$lastname</td></tr>";
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