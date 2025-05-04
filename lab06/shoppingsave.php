<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Lab 6" />
    <meta name="keywords" content="Web,programming" />
    <title>Understanding file and array functions</title>

    <link rel="stylesheet" href="assets/site.css" />
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <h2>Task 1: Understanding file and array functions</h2>
    <?php
    // Check if the form was submitted
    if (isset($_POST['item']) && isset($_POST['quantity'])) {
        // Get the item and quantity from the form
        $item = $_POST['item'];
        $quantity = $_POST['quantity'];
        $filename = './data/shop.txt';

        // Open the file in read mode
        $file = @fopen($filename, 'r');

        // Check if the file was opened successfully
        if ($file) {
            // Initialise an empty array to store existing data
            $alldata = array();

            // Read the existing data from the file and store it in an array
            while (!feof($file)) {
                $line = fgets($file);
                if ($line) {
                    list($existingItem, $existingQuantity) = explode(',', trim($line));
                    $alldata[] = [$existingItem, $existingQuantity];
                }
            }
            // Close the file stream
            fclose($file);

            // Check if the item already exists in the array
            // If it doesn't exist, add it to the array
            $newdata = false;
            if (!in_array($item, array_column($alldata, 0))) {
                // Add the new item and quantity to the array
                $alldata[] = [$item, $quantity];
                $newdata = true;
            }

            // Check if there is any new data to write to the file
            if ($newdata) {
                // Open the data file in append mode
                $file = @fopen($filename, 'a');

                // Check if the file was opened successfully
                if ($file) {
                    // Write the new item and quantity to the file
                    fwrite($file, "$item,$quantity\n");

                    echo "<p class='text-success'>Item '$item' with quantity '$quantity' has been saved to shop.txt.</p>";

                    // Close the file stream
                    fclose($file);
                } else {
                    echo "<p class='text-failure'>Error: Unable to open shop.txt for writing.</p>";
                }
            } else {
                echo "<p class='text-failure'>Item '$item' already exists in the shopping list.</p>";
            }
        } else {
            echo "<p class='text-failure'>Error: Unable to open shop.txt for writing.</p>";
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
        $filename = './data/shop.txt';
        $file = @fopen($filename, 'r');

        if (!$file || filesize($filename) == 0) {
            echo "<tr><td colspan='2'>The shopping list is currently empty.</td></tr>";
        } else {
            // Read each line from the file and display it as a table row
            while (!feof($file)) {
                $line = fgets($file);
                if ($line) {
                    list($item, $quantity) = explode(',', trim($line));
                    $shoppinglist[] = [$item, $quantity];
                }
            }

            // Sort the array by item name
            usort($shoppinglist, function ($a, $b) {
                return strcmp($a[0], $b[0]);
            });

            // Display each item and quantity in a table row
            foreach ($shoppinglist as $entry) {
                echo "<tr><td>$entry[0]</td><td>$entry[1]</td></tr>";
            }

            // Close the file stream
            fclose($file);
        }
        ?>
    </table>
    <script src="assets/site.js"></script>
</body>

</html>