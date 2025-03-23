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
            <li><a class="active" href="daysarray.php">Task 2</a></li>
            <li><a href="iseven.php">Task 3</a></li>
            <li><a href="iseven_form.php">Task 3 (Extension)</a></li>
        </ul>
        <h4>Jayden Earles (100684019)</h4>
    </div>
    <h2>Task 2: Experimenting on arrays</h2>
    <?php
    $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"); // declare and initialise array
    echo "<p>Days of the week in English are: $days[0], $days[1], $days[2], $days[3], $days[4], $days[5], $days[6]</p>"; // display the days of the week in English

    // convert the array values to be in French instead of English
    $days[0] = "Lundi";
    $days[1] = "Mardi";
    $days[2] = "Mercredi";
    $days[3] = "Jeudi";
    $days[4] = "Vendredi";
    $days[5] = "Samedi";
    $days[6] = "Dimanche";
    echo "<p>Days of the week in French are: $days[0], $days[1], $days[2], $days[3], $days[4], $days[5], $days[6]</p>";

    ?>
</body>

</html>