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
            <li><a class="active" href="module02.php">Task 1</a></li>
            <li><a href="daysarray.php">Task 2</a></li>
            <li><a href="iseven.php">Task 3</a></li>
            <li><a href="iseven_form.php">Task 3 (Extension)</a></li>
        </ul>
        <h4>Jayden Earles (100684019)</h4>
    </div>
    <h2>Task 1: Using variables, arrays and operators</h2>
    <?php
    $marks = array(85, 85, 95); // declare and initialise array
    $marks[1] = 90; // modify second element
    $ave = ($marks[0] + $marks[1] + $marks[2]) / count($marks); // compute average
    ($ave >= 50) // checks status
        ? $status = "PASSED"
        : $status = "FAILED";
    echo "<p>The average score is $ave. You $status</p>";
    ?>
</body>

</html>