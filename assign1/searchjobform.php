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
    <form action="searchjobprocess.php" method="get">
        <fieldset>
            <legend>Search Job Postings</legend>
            <div class="form-group">
                <label for="jobID">Position ID: <span class="text-failure">*</span></label>
                <input type="text" id="jobTitle" name="jobTitle" maxlength="20" pattern="[A-Za-z0-9\s,\.!]{1,20}" required />
                <input class="btn btn-primary" type="submit" value="Search" />
            </div>
        </fieldset>
        <br>
        <a href="index.php" class="btn btn-secondary">Back to Home</a>
    </form>
    <script src="assets/site.js"></script>
</body>

</html>