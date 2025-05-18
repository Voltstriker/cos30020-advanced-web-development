<?php
session_start();
if (isset($_SESSION['guess_count'])) {
    $guess_count = $_SESSION['guess_count'];
} else {
    $guess_count = 0;
}
if (!isset($_SESSION['number'])) {
    $num = rand(1, 100);
    $_SESSION['number'] = $num;
} else {
    $num = $_SESSION['number'];
}
if (isset($_POST['guess'])) {
    $guess = $_POST['guess'];
    $guess_count++;
    $_SESSION['guess_count'] = $guess_count;
} else {
    $guess = -1;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Lab 9" />
    <meta name="keywords" content="Web,programming" />
    <meta name="author" content="Jayden Earles" />
    <title>Managing State Information</title>

    <link rel="stylesheet" href="./site.css" />
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <h2>Task 2: Creating a simple "Guessing Game"</h2>
    <form method="post" action="guessinggame.php">
        <fieldset>
            <legend>Guess a number between 1 and 100</legend>
            <div class="form-group">
                <label for="guess">Enter your guess:</label>
                <input type="number" id="guess" name="guess" min="1" max="100" required <?php echo $guess == $num ? "disabled='disabled'" : ""; ?>>
                <input class="btn btn-primary" id="submitGuess" type="submit" value="Guess" <?php echo $guess == $num ? "disabled='disabled'" : ""; ?> />
            </div>
            <p>Guess Count: <?php echo $guess_count; ?></p>
            <?php
            if ($guess != -1) {
                if ($guess < $num) {
                    echo "<p class='text-failure text-bold'>Your guess is too low!</p>";
                } elseif ($guess > $num) {
                    echo "<p class='text-failure text-bold'>Your guess is too high!</p>";
                } else {
                    echo "<p class='text-success text-bold'>Congratulations! You guessed the number $num in $guess_count attempt" . ($guess > 1 ? "s" : "") . ".</p>";
                }
            }
            ?>
        </fieldset>
        <br>
        <?php
        if ($guess == $num) {
            echo '<a class="btn btn-tertiary" href="startover.php">Play Again</a>';
        } else {
            echo '<a class="btn btn-secondary" href="giveup.php">Give Up</a>';
            echo '<a class="btn btn-tertiary" href="startover.php">Start Over</a>';
        }
        ?>
    </form>
    <script src="scripts/site.js"></script>
</body>

</html>