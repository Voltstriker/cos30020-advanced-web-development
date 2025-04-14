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
    <?php
    // Check if the form was submitted
    if (isset($_POST['firstname']) && isset($_POST['lastname'])) {
        // Get the firstname and lastname from the form
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        // Open the file in append mode
        $file = fopen('./data/guestbook.txt', 'a');

        // Check if the file was opened successfully
        if ($file) {
            try {
                // Write the firstname and lastname to the file
                if (fwrite($file, "$lastname,$firstname\n") === false) {
                    throw new Exception("Write operation failed.");
                }

                // Close the file
                fclose($file);

                echo "<p class='text-success'>Thank you for signing our guest book, $firstname!</p>";
            } catch (Exception $e) {
                echo "<p class='text-failure'>Cannot add your name to the guest book.</p>";
            }
        } else {
            echo "<p class='text-failure'>Error: Unable to open guestbook.txt for writing.</p>";
        }
    } else {
        echo "<p>Please enter your name in the <a href=\"guestbookform.php\">input form</a>.</p>";
    }
    ?>
    <script src="assets/site.js"></script>
</body>

</html>