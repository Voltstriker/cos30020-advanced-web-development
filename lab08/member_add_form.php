<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Lab 7" />
    <meta name="keywords" content="Web,programming" />
    <meta name="author" content="Jayden Earles" />
    <title>MySQL Databases with PHP</title>

    <link rel="stylesheet" href="./site.css" />
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <h2>Task 2: VIP Member Registration System</h2>
    <a class="btn btn-primary" href="vip_member.php">Back to VIP Member Home</a>
    <a class="btn btn-secondary" href="member_display.php">Display All Members</a>
    <br><br>

    <form action="member_add.php" method="post">
        <p class="text-failure"><em>* Items marked with an asterix are mandatory</em></p>
        <fieldset>
            <legend>Enter the details of the new VIP member:</legend>

            <div class="form-group">
                <label for="firstname">First Name: <span class="text-failure">*</span></label>
                <input type="text" id="firstname" name="firstname" required /><br /><br />
            </div>

            <div class="form-group">
                <label for="lastname">Last Name: <span class="text-failure">*</span></label>
                <input type="text" id="lastname" name="lastname" required /><br /><br />
            </div>

            <div class="form-group">
                <label>Gender: <span class="text-failure">*</span></label>
                <div class="radio-group">
                    <input type="radio" id="genderM" name="gender" value="M" required />
                    <label for="genderM">Male</label>
                    <input type="radio" id="genderF" name="gender" value="F" required />
                    <label for="genderF">Female</label>
                    <input type="radio" id="genderO" name="gender" value="O" required />
                    <label for="genderO">Other</label>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email: <span class="text-failure">*</span></label>
                <input type="email" id="email" name="email" required /><br /><br />
            </div>

            <div class="form-group">
                <label for="phone">Phone: <span class="text-failure">*</span></label>
                <input type="tel" id="phone" name="phone" placeholder="+61" required />
            </div>
        </fieldset>
        <input class="btn btn-primary" type="submit" value="Submit" />
        <input class="btn btn-secondary" type="reset" value="Reset" />
    </form>

    <script src="scripts/site.js"></script>
</body>

</html>