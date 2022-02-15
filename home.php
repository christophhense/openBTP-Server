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

<?php
require ("./incs/rights.php");
?>


<script>
	function openFastCheckOut() {
		var js_usropwer = <?php echo $usrpower ?>;
		if (js_usropwer >= 3) {

		window.open("fastclockout.php", "_blank", "height=900,width=840,toolbar=no,scrollbars=no,resizable=no,menubar=no");
	} else {
			alert("Du hast leider nicht genügend Rechte!")
		
		}
	}

	function openSanBereich() {
		var js_usropwer = <?php echo $usrpower ?>;
		if (js_usropwer >= 2) {

		window.open("SanBereich.php", "_blank", "height=1080,width=1920,fullscreen=yes,toolbar=no,scrollbars=no,resizable=yes,menubar=no");
		} else {
			alert("Du hast leider nicht genügend Rechte!")
		
		}
	}
	
	function openAdminPanel() {

		var js_usropwer = <?php echo $usrpower ?>;
		if (js_usropwer >= 9) {
		
		window.location.href = "/adminpanel.php";
		} else {
			alert("Du hast leider nicht genügend Rechte!")
		}

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
			- Patient:innen können mehrfach ein- und ausgebucht werden und bekommen eine Historie<br>
			- Freitexteinträge in den Verlauf von Patient:innen<br>
			- Rechtesystem und Adminpanel zur Benutzerverwaltung
			
		</p>
		<p>
			Geplante Änderungen / Neuerungen:<br>
			- Stammdatenpflege<br>
			- Exportfunktion <br>
			- Echtzeit Notizen zur Kommunikation in der Lage mit Benachrichtigungen.<br>
			- Eigenständige Passwortänderung über die Profil-Seite (dann hat diese endlich einen erkennbaren Sinn ;) )<br>
		</p>
		<p><button onclick="openSanBereich()" class="">Übersichtsseite Sanität</button><br><br><button onclick="openFastCheckOut()" class="">Schnelles Ausstempeln zu Einsatzende</button> </p>
		
		<p><button onclick="openAdminPanel()" class="">Adminpanel</button></p>


	</div>

</body>

</html>