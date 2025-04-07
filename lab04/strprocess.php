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
    <h2>Task 1: Understanding string functions</h2>
    <?php
    // check if str1 exists in the form data
    if (isset($_POST["str1"])) {
        // get str1 from form data
        $str1 = $_POST["str1"];

        // check if str1 contains just alphanumeric characters and spaces
        $pattern = "/^[A-Za-z ]+$/";
        if (preg_match($pattern, $str1)) {
            // check if $str1 contains any vowels
            // if it does, remove them and display the new string
            $vowels = "/[aeiouAEIOU]/";
            if (preg_match($vowels, $str1)) {
                // remove vowels from $str1 and display the new string
                $str1_no_vowels = preg_replace($vowels, "", $str1);
                echo "<p>Original string: $str1</p>";
                echo "<p>String after removing vowels: $str1_no_vowels</p>";
            }
            // str1 does not contain any vowels
            else {
                echo "<p>The string does not contain any vowels.</p>";
            }
        }
        // string contains invalid characters
        else {
            echo "<p>Please enter a string containing only letters or space.</p>";
        }
    }
    // str1 is not set in the form data
    else {
        echo "<p>Please enter string from the input form.</p>";
    }
    ?>
    <script src="assets/site.js"></script>
</body>

</html>