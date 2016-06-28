<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "chatapplication";

	$mysqli = new mysqli($servername, $username, $password, $db);

	if ($mysqli->connect_error) {
	    die("Connection failed: " . $mysqli->connect_error);
	} 
	 //echo "Connected successfully";
?>
