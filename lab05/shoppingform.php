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
    <h2>Task 1: Understanding file functions</h2>
    <form action="shoppingsave.php" method="post">
        <fieldset>
            <legend>Shopping List</legend>
            <label for="item">Item:</label>
            <input type="text" id="item" name="item" required /><br /><br />

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" required /><br /><br />
        </fieldset>
        <input class="btn btn-primary" type="submit" value="Save to shopping list" />
        <input class="btn btn-secondary" type="reset" value="Clear form" />
    </form>
    <script src="assets/site.js"></script>
</body>

</html>