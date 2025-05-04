<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Jayden Earles" />
    <title>Updating the Guest Book System</title>

    <link rel="stylesheet" href="assets/site.css" />
</head>

<body>
    <?php
    // Display the page header
    include 'header.php';
    ?>
    <h2>Task 2: Updating the Guest Book System</h2>
    <form action="guestbooksave.php" method="post">
        <fieldset>
            <legend>Enter your details to sign our guest book</legend>
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" required /><br /><br />

            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" required /><br /><br />

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required /><br /><br />
        </fieldset>
        <input class="btn btn-primary" type="submit" value="Submit" />
        <input class="btn btn-secondary" type="reset" value="Reset" />
    </form>
    <script src="assets/site.js"></script>
</body>

</html>