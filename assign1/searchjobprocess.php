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

    <a href="searchjobform.php" class="btn btn-primary">New Search</a> <a href="index.php" class="btn btn-secondary">Back to Home</a><br>

    <?php
    // Check if the form was submitted
    if (isset($_GET['jobTitle'])) {
        // Get the job details from the form
        $formJobTitle = $_GET['jobTitle'];

        // Get other form values
        if (isset($_GET['jobPositionType'])) {
            $formJobPositionType = $_GET['jobPositionType'];
        } else {
            $formJobPositionType = null;
        }
        if (isset($_GET['jobContractType'])) {
            $formJobContractType = $_GET['jobContractType'];
        } else {
            $formJobContractType = null;
        }
        if (isset($_GET['jobLocation'])) {
            $formJobLocation = $_GET['jobLocation'];
        } else {
            $formJobLocation = null;
        }
        if (isset($_GET['jobAcceptMethod'])) {
            $formJobAcceptMethod = $_GET['jobAcceptMethod'];
        } else {
            $formJobAcceptMethod = null;
        }
        // Break the checkbox array into two variables
        if (is_array($formJobAcceptMethod)) {
            if (count($formJobAcceptMethod) > 1) {
                $formJobAcceptMethodPost = true;
                $formJobAcceptMethodEmail = true;
            } else {
                if ($formJobAcceptMethod[0] == 'Post') {
                    $formJobAcceptMethodPost = true;
                    $formJobAcceptMethodEmail = false;
                } else {
                    $formJobAcceptMethodPost = false;
                    $formJobAcceptMethodEmail = true;
                }
            }
        } else {
            $formJobAcceptMethodPost = false;
            $formJobAcceptMethodEmail = false;
        }

        // Set the file path for the job postings
        $filename = './jobposts/jobs.txt';

        // Check if the file exists, if not create it
        if (!file_exists($filename)) {
            $file = fopen($filename, 'w');
            fclose($file);
        }

        // Validate the input data
        if (empty($formJobTitle)) {
            echo "<p class='text-failure'>Error: Invalid form data received - no job title provided!</p>";
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
                    // Filter by job position type if provided
                    if (!empty($formJobPositionType) && $formJobPositionType !== null) {
                        $jobDetails = array_filter($jobDetails, function ($job) use ($formJobPositionType) {
                            return $job[4] === $formJobPositionType;
                        });
                    }
                    // Filter by job contract type if provided
                    if (!empty($formJobContractType) && $formJobContractType !== null) {
                        $jobDetails = array_filter($jobDetails, function ($job) use ($formJobContractType) {
                            return $job[5] === $formJobContractType;
                        });
                    }
                    // Filter by job location if provided
                    if (!empty($formJobLocation) && $formJobLocation !== null) {
                        $jobDetails = array_filter($jobDetails, function ($job) use ($formJobLocation) {
                            return $job[8] === $formJobLocation;
                        });
                    }
                    // Filter by job accept method if provided
                    if (!empty($formJobAcceptMethod) && $formJobAcceptMethod !== null) {
                        $jobDetails = array_filter($jobDetails, function ($job) use ($formJobAcceptMethod) {
                            return in_array($job[6], $formJobAcceptMethod) || in_array($job[7], $formJobAcceptMethod);
                        });
                    }
                    // Filter by job accept method post if provided
                    if ($formJobAcceptMethodPost) {
                        $jobDetails = array_filter($jobDetails, function ($job) {
                            return $job[6] == "1";
                        });
                    }
                    // Filter by job accept method email if provided
                    if ($formJobAcceptMethodEmail) {
                        $jobDetails = array_filter($jobDetails, function ($job) {
                            return $job[7] == "1";
                        });
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
                echo "<p class='text-failure'>No job postings found using the current search criteria.</p>";
            }
        } else {
            echo "<p class='text-failure'>Error: Failed to open the jobs.txt file for reading.</p>";
        }
    } else {
        echo "<p class='text-failure'>Invalid form submission (no job title provided) - please try submitting the form again.</p>";
    }
    ?>

    <script src="assets/site.js"></script>
</body>

</html>