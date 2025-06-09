<?php
// Import the MySQL connection details
require_once 'config.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Assignment 3: System development project 2" />
    <meta name="keywords" content="Web,programming" />
    <meta name="author" content="Jayden Earles" />
    <title>Sign Up | Assignment 3: System development project 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="site.css" />
</head>

<body>
    <div class="container-fluid wrapper">
        <div class="row">
            <div class="container wrapper-content">
                <div class="row">
                    <nav class="col-12 nav">
                        <div class="brand">
                            <span class="brand-image"></span>
                            <span class="brand-title">RazorBook</span>
                        </div>
                        <ul class="nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        </ul>
                        <div class="user">
                            <span><a class="btn btn-primary" href="signup.php">Login</a> | <a class="btn btn-secondary" href="signup.php">Register</a></span>
                        </div>
                    </nav>
                    <main class="col-12">
                        <div class="row site-content">
                            <form action="login.php" method="post" enctype="application/x-www-form-urlencoded">
                                <fieldset>
                                    <legend>Log In</legend>
                                    <p>Please fill in the form below to log in.</p>

                                    <label for="email" class="sr-only">Email address</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required>

                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                                </fieldset>

                                <button class="btn btn-primary" type="submit">Log In</button>
                            </form>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>