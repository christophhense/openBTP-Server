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

<script>
function openFastCheckOut() {

    window.open("fastclockout.php","_blank", "height=900,width=840,toolbar=no,scrollbars=no,resizable=no,menubar=no");
	}
	function openSanBereich() {

window.open("SanBereich.php","_blank", "height=1080,width=1920,fullscreen=yes,toolbar=no,scrollbars=no,resizable=yes,menubar=no");
}

	</script>



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
		<h2>Startseite</h2>
		<p>Wilkommen zurück, <?= $_SESSION['name'] ?>!<br>
	</p>

		<p>
		Änderungsübersicht:<br>
			- Vereinfachte Installation über eine ./install.php.
		</p>
		<p>
			Geplante Änderungen / Neuerungen:<br>
			- Patient:innen können mehrfach ein- und ausgebucht werden und bekommen eine Historie.<br>
			- Rechtesystem und Unterseite mit Einstellungen und Stammdatenpflege<br>
			- Echtzeit Notizen zur Kommunikation in der Lage mit Benachrichtigungen.<br>
			- Eigenständige Passwortänderung über die Profil-Seite (dann hat diese endlich einen erkennbaren Sinn ;) )<br>
		</p>
		<p><button onclick="openSanBereich()" class="">Übersichtsseite Sanität</button> </p>
		<p><button onclick="openFastCheckOut()" class="">Schnelles Ausstempeln zu Einsatzende</button> </p>
		
		
	</div>
	
</body>

</html>