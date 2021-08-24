<?php
include("dbConfig.php");
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	exit('Bitte vollständig ausfüllen!');
}
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	exit('Bitte vollständig ausfüllen!');
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	exit('Email nicht gültig');
}
if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
    exit('Username nicht gültig!');
}
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	exit('Bitte ein PW zwischen 5 und 20 Zeichen nutzen!');
}
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		echo 'Benutzername bereits vorhanden!';
	} else {
if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
	$stmt->execute();
	echo 'Erfolgreich regristriert!';
} else {
	echo 'Could not prepare statement!';
}
	}
	$stmt->close();
} else {
	echo 'Could not prepare statement!';
}
$con->close();
?>