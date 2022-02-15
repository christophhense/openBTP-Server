<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
require("./incs/rights.php");
  if ($usrpower == 1) {
	
    header("Location: ./statistik.php");
  }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BTP_Server</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="./fa/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>BTP-Server</h1>
				<a href="./home.php">Startseite</a>
				<a href="./eingabe.php">Neuer Patient</a>
				<a href="./tabelle.php">Übersicht Patient:innen</a>
				<a href="./statistik.php">Statistik</a>
				<a href="./lageinfos.php">Lageinfos</a>
				<a href="./logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Alle wichtigen Infos zum Einsatz</h2>
			<h3>Überblick</h3>
			<p>
				Einsatzort: <br>
				Grund der Betreuungsstelle: <br>
			</p>
			<h3>Funk & Kommunikation</h3>
			<p></p>
			<h3>Ansprechpartner*innen</h3>
			<p>
				BTP Führer: <br>
				Zugführer Betreuung: <br>
				Gruppenführer Registrierung: <br>
				Zugführer Sanität:<br>
				Gruppenführer Erstversorgung: <br>
			</p>
			<h3>Downloads</h3>
			<p>
				Hier sind alle wichtigen Dateien im Überblick:<br>
			</p>
			<h3>Vorgehensweise bei "Registratur in Papierform"</h3>
			<p></p>
		</div>
	</body>
</html>