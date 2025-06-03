<!DOCTYPE html>
<html>

<head>
	<title>Guest Book</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
	<?php
	require_once 'config.inc.php';

	// validate input
	if (empty($_GET['first_name']) || empty($_GET['last_name'])) {
		die("<p>You must enter your first and last name! Click your browser's Back button to return to the Guest Book form.</p>");
	}

	// select database
	$DBConnect = @mysqli_connect($hostname, $username, $password)
		or die("<p>Unable to connect to the database server.</p>"
			. "<p>Error code " . mysqli_connect_errno()
			. ": " . mysqli_connect_error()) . "</p>";

	// select and create database
	if (!@mysqli_select_db($DBConnect, $database)) {
		$SQLstring = "CREATE DATABASE $database IF NOT EXISTS";
		$QueryResult = @mysqli_query($DBConnect, $SQLstring)
			or die("<p>Unable to execute the query.</p>"
				. "<p>Error code " . mysqli_errno($DBConnect)
				. ": " . mysqli_error($DBConnect)) . "</p>";

		echo "<p>You are the first visitor!</p>";
		mysqli_select_db($DBConnect, $database);
	}

	// create table if necessary
	$TableName = "visitors";
	$SQLstring = "SELECT * FROM $TableName";
	$QueryResult = @mysqli_query($DBConnect, $SQLstring);
	if (!$QueryResult) {
		$SQLstring = "CREATE TABLE $TableName (countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, last_name VARCHAR(40), first_name VARCHAR(40))";
		$QueryResult = @mysqli_query($DBConnect, $SQLstring)
			or die("<p>Unable to create the table.</p>"
				. "<p>Error code " . mysqli_errno($DBConnect)
				. ": " . mysqli_error($DBConnect)) . "</p>";
	}

	// sign
	$LastName = addslashes($_GET['last_name']);
	$FirstName = addslashes($_GET['first_name']);
	$SQLstring = "INSERT INTO $TableName (last_name, first_name) VALUES('$LastName', '$FirstName')";
	$QueryResult = @mysqli_query($DBConnect, $SQLstring)
		or die("<p>Unable to execute the query.</p>"
			. "<p>Error code " . mysqli_errno($DBConnect)
			. ": " . mysqli_error($DBConnect)) . "</p>";
	echo "<h1>Thank you for signing our guest book!</h1>";

	mysqli_close($DBConnect);
	?>
</body>

</html>