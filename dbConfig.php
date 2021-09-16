<?php
	// Database configuration 
	$dbHost     = "localhost"; 
	$dbUsername = "admin"; 
	$dbPassword = "password"; 
	$dbName     = "dbname"; 
	 

	$con = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 

	// Also replace here
	$pdo = new PDO('mysql:host=localhost;dbname=dbname', 'admin', 'password');

?>
