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
    <form action="searchjobprocess.php" method="get">
        <p class="text-failure"><em>* Items marked with an asterix are mandatory</em></p>
        <fieldset>
            <legend>Search Job Postings</legend>
            <div class="form-group">
                <label for="jobTitle">Job Title: <span class="text-failure">*</span></label>
                <input type="text" id="jobTitle" name="jobTitle" maxlength="20" pattern="[A-Za-z0-9\s,\.!]{1,20}" required />
            </div>
            <div class="form-group">
                <label>Position:</label>
                <div class="radio-group">
                    <input type="radio" id="fullTime" name="jobPositionType" value="Full Time" />
                    <label for="jobPositionTypeFullTime">Full Time</label>
                    <input type="radio" id="partTime" name="jobPositionType" value="Part Time" />
                    <label for="jobPositionTypePartTime">Part Time</label>
                </div>
            </div>

            <div class="form-group">
                <label>Contract:</label>
                <div class="radio-group">
                    <input type="radio" id="jobContractTypeOnGoing" name="jobContractType" value="On-Going" />
                    <label for="jobContractTypeOnGoing">On-Going</label>
                    <input type="radio" id="jobContractTypeFixedTerm" name="jobContractType" value="Fixed Term" />
                    <label for="jobContractTypeFixedTerm">Fixed Term</label>
                </div>
            </div>

            <div class="form-group">
                <label>Accept Application by:</label>
                <div class="radio-group">
                    <input type="checkbox" id="jobAcceptMethodPost" name="jobAcceptMethodPost" value="Post" />
                    <label for="jobAcceptMethodPost">Post</label>
                    <input type="checkbox" id="jobAcceptMethodEmail" name="jobAcceptMethodEmail" value="Email" />
                    <label for="jobAcceptMethodEmail">Email</label>
                </div>
            </div>

            <div class="form-group">
                <label for="jobLocation">Location:</label>
                <select id="jobLocation" name="jobLocation">
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
            <input class="btn btn-primary" type="submit" value="Search" />
            <input class="btn btn-secondary" type="reset" value="Reset" />
        </fieldset>
        <br>
        <a href="index.php" class="btn btn-secondary">Back to Home</a>
    </form>
    <script src="scripts/searchjobform.js"></script>
    <script src="scripts/site.js"></script>
</body>

</html>