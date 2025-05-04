<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Assignment 2: System development project 1" />
    <meta name="keywords" content="Web,programming" />
    <meta name="author" content="Jayden Earles" />
    <title>Assignment 2: System development project 1</title>

    <link rel="stylesheet" href="assets/site.css" />
</head>

<body>
    <?php
    // Display the page header
    include 'header.php';
    ?>
    <h2>Job Vacancy Posting System</h2>

    <?php
    // Check if the form was submitted
    if (isset($_GET['jobTitle'])) {
        // Get the job details from the form
        $formJobTitle = $_GET['jobTitle'];

        // Set the file path for the job postings
        $filename = './jobposts/jobs.txt';

        // Check if the file exists, if not create it
        if (!file_exists($filename)) {
            $file = fopen($filename, 'w');
            fclose($file);
        }

        // Validate the input data
        if (empty($formJobTitle)) {
            echo "<p class='text-failure'>Error: All fields are required - please return to <a href='index.php'>Home</a> or <a href='searchjobform.php'>Search Jobs</a> page.</p>";
            exit;
        }

        // ======================================================
        // VALIDATION PASSED - Proceed to save the job posting
        // ======================================================

        // Open the file in append mode
        $file = @fopen($filename, 'r');

        // Check if the file was opened successfully
        if ($file) {
            // Initialise an empty array to store existing data
            $jobDetails = array();

            // Read the existing data from the file and store it in an array
            while (!feof($file)) {
                $line = fgets($file);
                if ($line) {
                    list($jobID, $jobTitle, $jobDescription, $jobClosingDate, $jobPositionType, $jobContractType, $jobAcceptMethodPost, $jobAcceptMethodMail, $jobLocation) = explode("\t", trim($line));
                    if (strpos($jobTitle, $formJobTitle) !== false) {
                        // Add the job details to the array
                        $jobDetails[] = [$jobID, $jobTitle, $jobDescription, $jobClosingDate, $jobPositionType, $jobContractType, $jobAcceptMethodPost, $jobAcceptMethodMail, $jobLocation];
                    }
                }
            }

            // Close the file stream
            fclose($file);

            // Swap 0 and 1 values for "True" and "False"
            // Iterate in-place through the job details array to convert boolean values
            foreach ($jobDetails as &$job) {
                $job[6] = ($job[6] == "1") ? "True" : "False";
                $job[7] = ($job[7] == "1") ? "True" : "False";
            }
            unset($job); // break the reference

            // Check if any job details were found
            if (count($jobDetails) > 0) {
                // Display nav buttons
                echo '<a href="searchjobform.php" class="btn btn-primary">New Search</a> <a href="index.php" class="btn btn-secondary">Back to Home</a>';
                // Display the job details
                echo "<table class='table'>";
                echo "<caption><strong>Job Postings for: $formJobTitle</strong></caption>";
                // Define table headers
                $headers = [
                    'Position ID',
                    'Title',
                    'Description',
                    'Close Date',
                    'Employment Type',
                    'Tenure Type',
                    'Job Accept Method (Post)',
                    'Job Accept Method (Mail)',
                    'Location'
                ];
                echo "<thead><tr>";
                foreach ($headers as $header) {
                    echo "<th>{$header}</th>";
                }
                echo "</tr></thead>";

                echo "<tbody>";
                foreach ($jobDetails as $job) {
                    echo "<tr>";
                    foreach ($job as $cell) {
                        echo "<td>{$cell}</td>";
                    }
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p class='text-failure'>No job postings found for the given title - please return to <a href='index.php'>Home</a> or <a href='searchjobform.php'>Search Jobs</a> page.</p>";
            }
        } else {
            echo "<p class='text-failure'>Error: Failed to open the jobs.txt file for reading - please return to <a href='index.php'>Home</a> or <a href='searchjobform.php'>Search Jobs</a> page.</p>";
        }
    } else {
        echo "<p class='text-failure'>Invalid form submission - please try submitting the <a href='searchjobform.php'>form</a> again.</p>";
    }
    ?>

    <script src="assets/site.js"></script>
</body>

</html>