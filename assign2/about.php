<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Assignment 3: System development project 2" />
    <meta name="keywords" content="Web,programming" />
    <meta name="author" content="Jayden Earles" />
    <title>About | Assignment 3: System development project 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="site.css" />
</head>

<body>
    <div class="container-fluid wrapper">
        <div class="row">
            <div class="container wrapper-content">
                <div class="row">
                    <nav class="col-12 nav">
                        <div class="brand brand-logo">
                            <img src="images/Razor.png" alt="RazorBook Logo" class="brand-image" />
                            <a class="brand-title" href="index.php">RazorBook</a>
                        </div>
                        <ul class="nav-pills">
                            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
                            <?php
                            // Check if the user is logged in to display the appropriate links
                            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                                echo '<li class="nav-item"><a class="nav-link" href="friendlist.php">Friend List</a></li>';
                                echo '<li class="nav-item"><a class="nav-link" href="friendadd.php">Add Friends</a></li>';
                            }
                            ?>
                        </ul>
                        <div class="user">
                            <?php
                            // Check if the user is logged in
                            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                                // Display the profile_name and logout link
                                echo '<span class="user-name">' . htmlspecialchars($_SESSION['profile_name']) . '</span>';
                                echo ' <a class="btn btn-secondary" href="logout.php">Logout</a>';
                            } else {
                                // Display login and register buttons
                                echo '<span><a class="btn btn-primary" href="login.php">Login</a> <a class="btn btn-secondary" href="signup.php">Register</a></span>';
                            }
                            ?>
                        </div>
                    </nav>

                    <div class="col-12 banner banner-warning <?php if (empty($warnings)) echo 'display-none' ?>">
                        <div class="row">
                            <div class="col col-12">
                                <h4>There were some issues when logging in:</h4>
                                <?php
                                // Display warning messages if any
                                if (!empty($warnings)) {
                                    echo '<ul class="warning-list">';
                                    foreach ($warnings as $warning) {
                                        echo '<li>' . htmlspecialchars($warning) . '</li>';
                                    }
                                    echo '</ul>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <main class="site-content">
                        <div class="container panel">
                            <div class="row">
                                <div class="col col-12">
                                    <h2>About RazorBook</h2>
                                    <p>RazorBook is a mock social-media website I have designed for this Assignment, playing on what might be Swinburne's take on a social media site.</p>
                                    <p>I have attempted all tasks listed within the assignment document, including the Extra Challenge tasks listed in Part 4.</p>
                                    <p>Additional features I have added include:</p>
                                    <ul>
                                        <li>Some very basic "security", where if the user is not logged in they will not be able to call functions that would impact a specific user, i.e. adding/removing friends</li>
                                        <li>Error handling, where if the user tries to add a friend that does not exist, it will not crash the site</li>
                                        <li>Basic styling to make the site look a little more appealing</li>
                                        <li>Modular css styling, where the css code has been broken into individual files and imported into a primary file</li>
                                        <li>Dynamic warning panel, where an array of warnings can be assigned to an array and displayed on the page</li>
                                        <li>Dynamic navigation bar, where the links displayed change based on whether the user is logged in or not</li>
                                        <li>Dynamic user profile, where the user's name is displayed in the navigation bar when logged in</li>
                                        <li>Added pagination to the friends list, as well as the add friends table that was required by the extra task</li>
                                    </ul>
                                    <p>The only section that required some consideration was how best to implement the add/remove friend system. I ended up deciding on a dedicated function to facilitate the action, which would be called via a button/link on the actual page itself.</p>
                                    <p>Looking back, I would have liked to spend more time on the site styling to make it more appealing as a website. Additionally, greater modularisation of my code would be a focus, moving as much as possible into reusable functions.</p>
                                    <p>Due to personal commitments, I have been unable to start the assignment until close to the due date, so have not had an opportunity to interact with my peers on the discussion board.</p>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>