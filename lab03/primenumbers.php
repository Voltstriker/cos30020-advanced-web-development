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
            <li><a href="leapyear_selfcall.php">Task 2: Extension</a></li>
            <li><a class="active" href="primenumbers.php">Task 3</a></li>
            <li><a href="primenumbersform.php">Task 3: Form</a></li>
        </ul>
        <h4>Jayden Earles (100684019)</h4>
    </div>
    <h2>Functions and Control Structures</h2>
    <?php
    function is_prime($num)
    {
        for ($i = 2; $i < $num; $i++) {                                        // loop from 2 to the value of $num
            if ($num % $i == 0) {                                               // check if $num is divisible by $i
                return false;                                                   // not prime
            }
        }

        return true;                                                            // prime if no numbers found
    }

    if (isset($_GET['number'])) {                                               // check if form data exists
        $num = $_GET['number'];                                                 // obtain the form data
        if (is_numeric($num)) {                                                 // check if $num is a positive number
            if ($num == round($num)) {                                          // check if $num is an integer
                if ($num > 0 && $num < 1000) {                                  // check if num is between 1 and 999
                    if (is_prime($num)) {                                       // check if $num is a prime number
                        echo "<p>", $num, " is a prime number.</p>";
                    } else {
                        echo "<p>", $num, " is not a prime number.</p>";
                    }
                } else {
                    echo "<p>Please enter an integer between 1 and 999.</p>";   // number is not between 1 and 999
                }
            } else {
                echo "<p>Please enter an integer.</p>";                         // number is not an integer
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