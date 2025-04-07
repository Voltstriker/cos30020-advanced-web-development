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
    <form action="perfectpalindrome.php" method="post">
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