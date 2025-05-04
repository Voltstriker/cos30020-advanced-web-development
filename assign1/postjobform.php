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
    <form action="postjobprocess.php" method="post">
        <p class="text-failure"><em>* Items marked with an asterix are mandatory</em></p>
        <fieldset>
            <legend>Job Posting</legend>

            <div class="form-group">
                <label for="jobID">Position ID: <span class="text-failure">*</span></label>
                <input type="text" id="jobID" name="jobID" required />
            </div>

            <div class="form-group">
                <label for="jobTitle">Title: <span class="text-failure">*</span></label>
                <input type="text" id="jobTitle" name="jobTitle" required />
            </div>

            <div class="form-group">
                <label for="jobDescription">Description: <span class="text-failure">*</span></label>
                <textarea type="text" id="jobDescription" name="jobDescription" required></textarea>
            </div>

            <div class="form-group">
                <label for="jobClosingDate">Closing Date: <span class="text-failure">*</span></label>
                <input type="date" id="jobClosingDate" name="jobClosingDate" value="<?php echo date('Y-m-d'); ?>" required />
            </div>

            <div class="form-group">
                <label>Position: <span class="text-failure">*</span></label>
                <div>
                    <input type="radio" id="fullTime" name="jobPositionType" value="Full Time" required />
                    <label for="jobPositionTypeFullTime">Full Time</label>
                    <input type="radio" id="partTime" name="jobPositionType" value="Part Time" required />
                    <label for="jobPositionTypePartTime">Part Time</label>
                </div>
            </div>

            <div class="form-group">
                <label>Contract: <span class="text-failure">*</span></label>
                <div>
                    <input type="radio" id="jobContractTypeOnGoing" name="jobContractType" value="On-Going" required />
                    <label for="jobContractTypeOnGoing">On-Going</label>
                    <input type="radio" id="jobContractTypeFixedTerm" name="jobContractType" value="Fixed Term" required />
                    <label for="jobContractTypeFixedTerm">Fixed Term</label>
                </div>
            </div>

            <div class="form-group">
                <label>Accept Application by: <span class="text-failure">*</span></label>
                <div>
                    <input type="checkbox" id="jobAcceptPost" name="jobAcceptMethod[]" value="Post" />
                    <label for="jobAcceptPost">Post</label>
                    <input type="checkbox" id="jobAcceptEmail" name="jobAcceptMethod[]" value="Email" />
                    <label for="jobAcceptEmail">Email</label>
                </div>
            </div>

            <div class="form-group">
                <label for="jobLocation">Location: <span class="text-failure">*</span></label>
                <select id="jobLocation" name="jobLocation" required>
                    <option value="" disabled selected>---</option>
                    <option value="ACT">ACT</option>
                    <option value="NSW">NSW</option>
                    <option value="NT">NT</option>
                    <option value="QLD">QLD</option>
                    <option value="SA">SA</option>
                    <option value="TAS">TAS</option>
                    <option value="VIC">VIC</option>
                    <option value="WA">WA</option>
                </select>
            </div>
        </fieldset>
        <input class="btn btn-primary" type="submit" value="Submit" />
        <input class="btn btn-secondary" type="reset" value="Reset" />
    </form>
    <script src="assets/site.js"></script>
</body>

</html>