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
    <h2>Task 3: Practicing the use of str_replace</h2>
    <?php
    // check if str1 exists in the form data
    if (isset($_POST["str1"])) {
        // get str1 from form data and convert to lowercase
        // this is done to ensure that the comparison is case insensitive
        $str1 = $_POST["str1"];
        $str1_lower = stripslashes(strtolower($str1));

        // remove all non-alphanumeric characters from the string
        $punctuation = [
            '!',
            '"',
            '#',
            '$',
            '%',
            '&',
            '\'',
            '(',
            ')',
            '*',
            '+',
            ',',
            '-',
            '.',
            '/',
            ':',
            ';',
            '<',
            '=',
            '>',
            '?',
            '@',
            '[',
            '\\',
            ']',
            '^',
            '_',
            '`',
            '{',
            '|',
            '}',
            '~'
        ];
        $str1_cleansed = str_replace($punctuation, '', $str1_lower);

        // check if str1 is a palindrome
        // a palindrome is a string that reads the same forwards and backwards
        if (strcmp($str1_cleansed, strrev($str1_cleansed)) == 0) {
            echo "<p class=\"text-success\">The string <strong>'$str1'</strong> is a palindrome.</p>";
        } else {
            echo "<p class=\"text-failure\">The string <strong>'$str1'</strong> is not a palindrome.</p>";
        }
    }
    // str1 is not set in the form data
    else {
        echo "<p class=\"text-warning\">Please enter a string from the input form.</p>";
    }
    ?>
    <form action="standardpalindromeself.php" method="post">
        <fieldset>
            <legend>String Manipulation</legend>
            <label for="str1">Enter a string:</label><br />
            <input type="text" id="str1" name="str1" required /><br /><br />
            <input type="submit" value="Submit" />
            <input type="reset" value="Reset" />
        </fieldset>
    </form>
    <script src="assets/site.js"></script>
</body>

</html>