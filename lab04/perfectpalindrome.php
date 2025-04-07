<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Jayden Earles" />
    <title>Understanding string functions</title>

    <link rel="stylesheet" href="assets/site.css" />
</head>

<body>
    <?php
    // Display the page header
    include 'header.php';
    ?>
    <h2>Task 2: Practicing string functions</h2>
    <?php
    // check if str1 exists in the form data
    if (isset($_POST["str1"])) {
        // get str1 from form data and convert to lowercase
        // this is done to ensure that the comparison is case insensitive
        $str1 = $_POST["str1"];
        $str1_lower = strtolower($str1);

        // check if str1 is a palindrome
        // a palindrome is a string that reads the same forwards and backwards
        if (strcmp($str1_lower, strrev($str1_lower)) == 0) {
            echo "<p>The string <strong>'$str1'</strong> is a palindrome.</p>";
        } else {
            echo "<p>The string <strong>'$str1'</strong> is not a palindrome.</p>";
        }
    }
    // str1 is not set in the form data
    else {
        echo "<p>Please enter a string from the input form.</p>";
    }
    ?>
    <script src="assets/site.js"></script>
</body>

</html>