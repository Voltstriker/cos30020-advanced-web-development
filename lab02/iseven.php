<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Lab 2" />
    <meta name="keywords" content="Web,programming" />
    <title>Working with Data Types and Operators</title>

    <link rel="stylesheet" href="assets/site.css" />
</head>

<body>
    <div id="header">
        <h1>Web Programming - Lab 2</h1>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="module02.php">Task 1</a></li>
            <li><a href="daysarray.php">Task 2</a></li>
            <li><a class="active" href="iseven.php">Task 3</a></li>
            <li><a href="iseven_form.php">Task 3 (Extension)</a></li>
        </ul>
        <h4>Jayden Earles (100684019)</h4>
    </div>
    <h2>Task 3: Using expression and looking up built-in functions</h2>
    <?php
    $number = 5; // define the number
    if (is_numeric($number)) { // determine if the value is a number
        $isEven = ($number % 2 == 0) ? "even" : "odd"; // determine if the number is even or odd
        echo "<p>The number $number is $isEven</p>";
    } else {
        echo "<p>The value is not a number</p>"; // if the value is not a number, display this message
    }

    ?>
</body>

</html>