<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Lab 5" />
    <meta name="keywords" content="Web,programming" />
    <title>Updating the Guest Book System</title>

    <link rel="stylesheet" href="assets/site.css" />
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <h2>Task 2: Updating the Guest Book System</h2>
    <?php
    // Check if the form was submitted
    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email'])) {
        // Get the firstname and lastname from the form
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];

        // Validate the input data
        $rgxEmail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if (!preg_match($rgxEmail, $email)) {
            echo "<p class='text-failure'>Invalid email format.</p>";
            exit;
        }

        // Open the file in read mode
        $filename = './data/guestbook.txt';
        $file = fopen($filename, 'r');

        // Check if the file was opened successfully
        if ($file) {
            // Initialise an empty array to store existing data
            $alldata = array();

            // Read the existing data from the file and store it in an array
            while (!feof($file)) {
                $line = fgets($file);
                if ($line) {
                    list($existingLastname, $existingFirstname, $existingEmail) = explode(',', trim($line));
                    $alldata[] = [$existingFirstname, $existingLastname, $existingEmail];
                }
            }

            // Close the file stream
            fclose($file);

            // Check if the name already exists in the array
            $newdata = true;
            if (in_array([$firstname, $lastname, $email], $alldata)) {
                echo "<p class='text-failure'>You have already signed our guest book.</p>";
                $newdata = false;
            }
        }

        if ($newdata) {
            // Open the file in append mode
            $file = fopen($filename, 'a');

            // Check if the file was opened successfully
            if ($file) {
                try {
                    // Write the firstname and lastname to the file
                    if (fwrite($file, "$lastname,$firstname,$email\n") === false) {
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
        }
    } else {
        echo "<p class='text-warning'>Please enter your name in the <a href=\"guestbookform.php\">input form</a>.</p>";
    }
    ?>
    <br>
    <a class="btn btn-primary" href="guestbookform.php">Sign the guest book</a>
    <a class="btn btn-secondary" href="guestbookshow.php">See signatures</a>
    <script src="assets/site.js"></script>
</body>

</html>