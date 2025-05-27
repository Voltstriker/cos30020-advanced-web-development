<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Lab 10" />
    <meta name="keywords" content="Web,programming" />
    <meta name="author" content="Jayden Earles" />
    <title>Developing Object Oriented PHP</title>

    <link rel="stylesheet" href="./site.css" />
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <h2>Task 1: Monster Class</h2>
    <?php
    require_once 'monsterclass.php';

    // Create Monster objects
    $monster1 = new Monster(1, "red");
    $monster2 = new Monster(3, "blue");

    echo "<p>" . $monster1->describe() . "</p>";
    echo "<p>" . $monster2->describe() . "</p>";

    ?>
    <script src="scripts/site.js"></script>
</body>

</html>