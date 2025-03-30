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
            <li><a class="active" href="factorial.php">Task 1</a></li>
            <li><a href="factorialform.php">Task 1: Form</a></li>
            <li><a href="leapyear.php">Task 2</a></li>
            <li><a href="leapyearform.php">Task 2: Form</a></li>
            <li><a href="leapyear_selfcall.php">Task 2: Extension</a></li>
            <li><a href="primenumbers.php">Task 3</a></li>
            <li><a href="primenumbersform.php">Task 3: Form</a></li>
        </ul>
        <h4>Jayden Earles (100684019)</h4>
    </div>
    <h2>Task 1: Using if and while statements</h2>
    <?php
    if (isset($_GET['number'])) {                                           // check if form data exists
        $num = $_GET['number'];                                             // obtain the form data
        if (is_numeric($num) && $num >= 0) {                                // check if $num is a positive number
            if ($num == round($num)) {                                      // check if $num is an integer
                echo "<p>", $num, "! is ", factorial($num), ".</p>";
            } else {                                                        // number is not an integer
                echo "<p>Please enter an integer.</p>";
            }
        } else {                                                            // number is not positive
            echo "<p>Please enter a positive integer.</p>";
        }
    } else {                                                                // no input
        echo "<p>Please enter a positive integer.</p>";
    }
    ?>
</body>

</html>