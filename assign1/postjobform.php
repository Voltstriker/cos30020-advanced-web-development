<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Assignment 2: System development project 1" />
    <meta name="keywords" content="Web,programming" />
    <meta name="author" content="Jayden Earles" />
    <title>Assignment 2: System development project 1</title>

    <link rel="stylesheet" href="./site.css" />
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
                <input type="text" id="jobID" name="jobID" maxlength="5" pattern="P[0-9]{4}" placeholder="P1234" required />
            </div>

            <div class="form-group">
                <label for="jobTitle">Title: <span class="text-failure">*</span></label>
                <input type="text" id="jobTitle" name="jobTitle" maxlength="20" pattern="[A-Za-z0-9\s,\.!]+" required />
            </div>

            <div class="form-group">
                <label for="jobDescription">Description: <span class="text-failure">*</span></label>
                <textarea type="text" id="jobDescription" name="jobDescription" maxlength="260" required></textarea>
            </div>

            <div class="form-group">
                <label for="jobClosingDate">Closing Date: <span class="text-failure">*</span></label>
                <input type="date" id="jobClosingDate" name="jobClosingDate" value="<?php echo date('Y-m-d'); ?>" required />
            </div>

            <div class="form-group">
                <label>Position: <span class="text-failure">*</span></label>
                <div class="radio-group">
                    <input type="radio" id="fullTime" name="jobPositionType" value="Full Time" required />
                    <label for="jobPositionTypeFullTime">Full Time</label>
                    <input type="radio" id="partTime" name="jobPositionType" value="Part Time" required />
                    <label for="jobPositionTypePartTime">Part Time</label>
                </div>
            </div>

            <div class="form-group">
                <label>Contract: <span class="text-failure">*</span></label>
                <div class="radio-group">
                    <input type="radio" id="jobContractTypeOnGoing" name="jobContractType" value="On-Going" required />
                    <label for="jobContractTypeOnGoing">On-Going</label>
                    <input type="radio" id="jobContractTypeFixedTerm" name="jobContractType" value="Fixed Term" required />
                    <label for="jobContractTypeFixedTerm">Fixed Term</label>
                </div>
            </div>

            <div class="form-group">
                <label>Accept Application by: <span class="text-failure">*</span></label>
                <div class="radio-group">
                    <input type="checkbox" id="jobAcceptMethodPost" name="jobAcceptMethodPost" value="Post" required />
                    <label for="jobAcceptMethodPost">Post</label>
                    <input type="checkbox" id="jobAcceptMethodEmail" name="jobAcceptMethodEmail" value="Email" required />
                    <label for="jobAcceptMethodEmail">Email</label>
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
    <script src="scripts/site.js"></script>
    <script src="scripts/postjobform.js"></script>
</body>

</html>