<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>BTP_Server</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<body class="loggedin">
	<nav class="navtop">
		<div>
			<h1>BTP-Server</h1>
			<a href="./home.php">Startseite</a>
			<a href="./eingabe.php">Neuer Patient</a>
			<a href="./tabelle.php">Übersicht Patienten</a>
			<a href="./statistik.php">Statistik</a>
			<a href="./lageinfos.php">Lageinfos</a>
			<a href="./logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</div>
	</nav>
	<div class="content">
		<h2>Startseite</h2>
		<p>Wilkommen zurück, <?= $_SESSION['name'] ?>!<br>
	</p>

		<p>
		Änderungsübersicht:<br>
			- Lageübersichtsseite hinzugekommen. Hier findet ihr alle Infos zum Einsatz, sowie die Downloads.<br>
			- Der SanBereich hat eine eigene Unterseite bekommen wo nur Patienten aus dem SanBereich angezeigt werden.<br>
			- Verinfachte installation über eine /install.php
		</p>
		<p>
			Geplante Änderungen / Neuerungen:<br>
			- Patient*innen können mehrfach ein und ausgebucht werden und bekommen eine Historie.<br>
			- Rechtesystem und Unterseite mit Einstellungen und Stammdatenpflege<br>
			- Echtzeit Notizen zur Kommunikation in der Lage mit Benachrichtigungen.<br>
			- Eigenständige Passwortänderung über die Profil-Seite (dann hat diese endlich einen erkennbaren Sinn ;) )<br>
			
			


		</p>
		<p><a href="./sanbereich.php">Hier geht es zum SanBereich</a></p>
		
	</div>
	
</body>

</html>