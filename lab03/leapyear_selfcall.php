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
    <div id="header">
        <h1>Web Programming - Lab 3</h1>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="factorial.php">Task 1</a></li>
            <li><a href="factorialform.php">Task 1: Form</a></li>
            <li><a href="leapyear.php">Task 2</a></li>
            <li><a href="leapyearform.php">Task 2: Form</a></li>
            <li><a class="active" href="leapyear_selfcall.php">Task 2: Extension</a></li>
            <li><a href="primenumbers.php">Task 3</a></li>
            <li><a href="primenumbersform.php">Task 3: Form</a></li>
        </ul>
        <h4>Jayden Earles (100684019)</h4>
    </div>
    <h2>Functions and Control Structures</h2>
    <form action="leapyear_selfcall.php" method="get">
        <label for="year">Enter a year:</label>
        <input type="text" id="year" name="year" min="0" required>
        <input type="submit" value="Check if Leap Year">
        <input type="reset" value="Reset">
    </form>
    <?php
    function is_leapyear($year)
    {
        return $year % 4 == 0 && ($year % 100 != 0 || $year % 400 == 0);
    }

    if (isset($_GET['year'])) {                                                 // check if form data exists
        $year = $_GET['year'];                                                  // obtain the form data
        if (is_numeric($year) && $year >= 0) {                                  // check if $year is a positive number
            if ($year == round($year)) {                                        // check if $year is an integer
                if (is_leapyear($year)) {                                       // check if $year is a leap year
                    echo "<p>", $year, " is a leap year.</p>";
                } else {
                    echo "<p>", $year, " is not a leap year.</p>";
                }
            } else {                                                            // number is not an integer
                echo "<p>Please enter an integer.</p>";
            }
        } else {                                                                // number is not positive
            echo "<p>Please enter a positive integer.</p>";
        }
    } else {                                                                    // no input
        echo "<p>Please enter a positive integer.</p>";
    }
    ?>
</body>

</html>