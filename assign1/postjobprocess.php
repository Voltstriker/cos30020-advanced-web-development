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
    if (isset($_POST['jobID']) && isset($_POST['jobTitle']) && isset($_POST['jobLocation'])) {
        // Get the job details from the form
        $jobID = $_POST['jobID'];
        $jobTitle = $_POST['jobTitle'];
        $jobDescription = $_POST['jobDescription'];
        $jobClosingDate = $_POST['jobClosingDate'];
        $jobPositionType = $_POST['jobPositionType'];
        $jobContractType = $_POST['jobContractType'];
        $jobLocation = $_POST['jobLocation'];

        // Handle checkboxes for job accept methods
        if (!isset($_POST['jobAcceptMethodPost'])) {
            $jobAcceptMethodPost = false;
        } else {
            $jobAcceptMethodPost = true;
        }
        if (!isset($_POST['jobAcceptMethodEmail'])) {
            $jobAcceptMethodEmail = false;
        } else {
            $jobAcceptMethodEmail = true;
        }

        // Set the file path for the job postings
        $filename = './jobposts/jobs.txt';

        // Check if the file exists, if not create it
        if (!file_exists($filename)) {
            $file = fopen($filename, 'w');
            fclose($file);
        }

        // Validate the input data
        if (empty($jobID) || empty($jobTitle) || empty($jobDescription) || empty($jobClosingDate) || empty($jobPositionType) || empty($jobContractType) || empty($jobLocation)) {
            echo "<p class='text-failure'>Error: Invalid form data received - please try submitting the form again.</p>";
            exit;
        }

        // Validate the job closing date format to ensure it is in format dd/mm/yyyy
        if (preg_match('/^\d{4}\-\d{2}\-\d{2}$/', $jobClosingDate)) {
            // Convert the job closing date to DD/MM/YYYY format
            $dateParts = explode('-', $jobClosingDate);
            $jobClosingDate = $dateParts[2] . '/' . $dateParts[1] . '/' . $dateParts[0];
        } else {
            echo "<p class='text-failure'>Error: Job closing date format is in an invalid format.</p>";
            exit;
        }

        // Validate the job ID format to ensure it is in format P1234
        if (!preg_match('/^P\d{4}$/', $jobID)) {
            echo "<p class='text-failure'>Error: Job ID format is invalid. It should be in the format P1234.</p>";
            exit;
        }
        // Check if the job ID already exists in the file
        else {
            $file = @fopen($filename, 'r');
            if ($file) {
                $jobExists = false;
                while (($line = fgets($file)) !== false) {
                    $fields = explode("\t", $line);
                    if (trim($fields[0]) === $jobID) {
                        $jobExists = true;
                        break;
                    }
                }
                fclose($file);

                if ($jobExists) {
                    echo "<p class='text-failure'>Error: Job ID already exists. Please use a unique Job ID.</p>";
                    exit;
                }
            } else {
                echo "<p class='text-failure'>Error: Failed to open the file for reading.</p>";
                exit;
            }
        }

        // Check if the job title is valid (certain characters and max of 20 characters)
        if (strlen($jobTitle) > 20 || !preg_match('/^[A-Za-z0-9\s,\.!]+$/', $jobTitle)) {
            echo "<p class='text-failure'>Error: Job title is invalid. It should be a maximum of 20 characters and can only contain letters, numbers, spaces, and hyphens.</p>";
            exit;
        }

        // Check if the job description is valid (certain characters and max of 260 characters)
        if (strlen($jobDescription) > 260) {
            echo "<p class='text-failure'>Error: Job description is invalid. It should be a maximum of 260 characters.</p>";
            exit;
        }

        // ======================================================
        // VALIDATION PASSED - Proceed to save the job posting
        // ======================================================

        // Open the file in append mode
        $file = @fopen($filename, 'a');

        // Check if the file was opened successfully
        if ($file) {
            // Write the job details to the file
            fwrite($file, "$jobID\t$jobTitle\t$jobDescription\t$jobClosingDate\t$jobPositionType\t$jobContractType\t$jobAcceptMethodPost\t$jobAcceptMethodEmail\t$jobLocation\n");

            // Close the file stream
            fclose($file);

            echo "<p class='text-success'>Job posting saved successfully - <a href='index.php'>click here</a> to return home.</p>";
        } else {
            echo "<p class='text-failure'>Error: Failed to open the file for writing.</p>";
        }
    } else {
        echo "<p class='text-failure'>Invalid form submission - please try submitting the <a href='postjobform.php'>form</a> again.</p>";
    }
    ?>

    <script src="scripts/site.js"></script>
</body>

</html>