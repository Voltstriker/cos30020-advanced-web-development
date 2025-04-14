<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Lab 5" />
    <meta name="keywords" content="Web,programming" />
    <title>Files and Directories</title>

    <link rel="stylesheet" href="assets/site.css" />
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <h2>Task 1: Understanding file functions</h2>
    <?php
    // Check if the form was submitted
    if (isset($_POST['item']) && isset($_POST['quantity'])) {
        // Get the item and quantity from the form
        $item = $_POST['item'];
        $quantity = $_POST['quantity'];

        // Open the file in append mode
        $file = @fopen('./data/shoppinglist.txt', 'a');

        // Check if the file was opened successfully
        if ($file) {
            // Write the item and quantity to the file
            fwrite($file, "$item,$quantity\n");

            // Close the file
            fclose($file);

            echo "<p class='text-success'>Item '$item' with quantity '$quantity' has been saved to shoppinglist.txt.</p>";
        } else {
            echo "<p class='text-failure'>Error: Unable to open shoppinglist.txt for writing.</p>";
        }
    } else {
        echo "<p class='text-warning'>Please enter item and quantity in the <a href=\"shoppingform.php\">input form</a>.</p>";
    }
    ?>
    <table>
        <caption>Current Shopping List</caption>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
        </tr>
        <?php
        // Open the file in read mode
        // The @ operator suppresses error messages that would normally be displayed
        $file = @fopen('./data/shoppinglist.txt', 'r');

        if (!$file) {
            echo "<tr><td colspan='2'>The shopping list is currently empty.</td></tr>";
        } else {
            // Read each line from the file and display it as a table row
            while (($line = fgets($file)) !== false) {
                list($item, $quantity) = explode(',', trim($line));
                echo "<tr><td>$item</td><td>$quantity</td></tr>";
            }

            // Close the file
            fclose($file);
        }
        ?>
    </table>
    <script src="assets/site.js"></script>
</body>

</html>