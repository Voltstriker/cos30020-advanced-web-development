<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Lab 3" />
    <meta name="keywords" content="Web,programming" />
    <title>Functions and Control Structures</title>

    <link rel="stylesheet" href="assets/site.css" />
</head>

<body>
    <?php
    // include the mathfunctions.php file to use the factorial function
    include 'mathfunctions.php';
    ?>
    <div id="header">
        <h1>Web Programming - Lab 3</h1>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="factorial.php">Task 1</a></li>
            <li><a href="factorialform.php">Task 1: Form</a></li>
            <li><a href="leapyear.php">Task 2</a></li>
            <li><a class="active" href="leapyearform.php">Task 2: Form</a></li>
        </ul>
        <h4>Jayden Earles (100684019)</h4>
    </div>
    <h2>Task 2: Using if statement</h2>
    <form action="leapyear.php" method="get">
        <label for="year">Enter a year:</label>
        <input type="text" id="year" name="year" min="0" required>
        <input type="submit" value="Check if Leap Year">
        <input type="reset" value="Reset">
    </form>
</body>

</html>