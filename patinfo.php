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

  <title>Patient:in</title>
  <meta content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="./fa/css/all.css">
</head>
<script>
  function MenuCheckOut() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const selectedID = urlParams.get('selectedID')
    window.location.href = "clockout.php?selectedID=" + selectedID;

  }
  function MenuCheckIn() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const selectedID = urlParams.get('selectedID')
    window.location.href = "checkin.php?selectedID=" + selectedID;

  }

  function MenuLogEntry(){
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const selectedID = urlParams.get('selectedID')
    window.location.href = "logentry.php?selectedID=" + selectedID;
  
  }

  function MenuPrint() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const selectedID = urlParams.get('selectedID')
    window.open("printpatdata.php?selectedID=" + selectedID, "_blank", "toolbar=no,scrollbars=yes,resizable=yes,");
  }

  function MenuRefresh() {
    location.reload();
  }
  function MenuGoBack(){
    window.history.back();
  }

  function extendDropdown() {
    document.getElementById("dropdownChangeRoom").classList.toggle("show");
  }

  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }

  function extendDropdown2() {
    document.getElementById("dropdownDelPat").classList.toggle("show");
  }
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
</script>


<body class="body">
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
<div class="container">
  <?php

  include('./incs/db_credentials.inc.php');
  $con = new mysqli($db_host, $db_user, $db_password, $db_name); 
  $ID = $_GET["selectedID"];

  $sql = "SELECT * FROM patienten WHERE ID = $ID";
  $result = mysqli_query($con, $sql);
  echo "<br><h3>Übersicht:</h3>";

  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";

    echo "<p>Name: " . $row["nachname"] . ", " . $row["vorname"] . "<br> 
    Geburtsdatum: " . $row["geburtsdatum"] . "<br>
    Adresse: " . $row["adresse"] . "<br>
    Telefonnummer: " . $row["telefon"] . "<br></p>
    <p>Vorerkrankungen: " . $row["erkrankungen"] . "<br>
    Medikation: " . $row["medis"] . " | Diese ausreichend? " . $row["medisgenug"] . "<br>
    Material: " . $row["material"] . "<br>
    Mobilität: " . $row["mobility"] . "<br></p>
    <p>Transportmittel: " . $row["TMittel"] . "<br>
    Zuletzt zugewiesener Aufenthaltsraum: " . $row["ort"] . "<br>
    Bemerkungen: " . $row["bemerkungen"] . "<br></p>";
  }

  $sql = "SELECT EventID, Event, timestamp FROM patlog WHERE PatID = $ID";
  $result = mysqli_query($con, $sql);
  echo "
  <br>
  <p><h3>Verlauf:</h3></p>
  <table>

  ";
  while ($row = mysqli_fetch_assoc($result)) {
  
  echo "<tr><td>"  . $row["timestamp"] . " :</td><td> " . $row["Event"] . "</td></tr>";
  
  }
  echo"</table>";

  ?>
</div>
  <div>
    <a class="dropdown">
      <button onclick="extendDropdown()" class="dropbtn">Aufenthaltsraum ändern</button>
      <div id="dropdownChangeRoom" class="dropdown-content">
        <a href="./changeroom.php?selectedID=<?php echo $ID ?>&room=Aula">Aula</a>
        <a href="./changeroom.php?selectedID=<?php echo $ID ?>&room=Sporthalle">Sporthalle</a>
        <a href="./changeroom.php?selectedID=<?php echo $ID ?>&room=Turnhalle1">Turnhalle 1</a>
        <a href="./changeroom.php?selectedID=<?php echo $ID ?>&room=Turnhalle2">Turnhalle 2</a>
        <a href="./changeroom.php?selectedID=<?php echo $ID ?>&room=Turnhalle3">Turnhalle 3</a>
        <a href="./changeroom.php?selectedID=<?php echo $ID ?>&room=SanBereich">SanBereich</a>
      </div>
    </a>

    <a><button onclick="MenuLogEntry()" class="button">Eintrag erstellen</button></a>

    <a> <button onclick="MenuCheckIn()" class="button">Check-In</button> </a>

    <a> <button onclick="MenuCheckOut()" class="button">Check-Out</button> </a>
      
    <a class="dropdown">
      <button onclick="extendDropdown2()" class="dropbtn">Patient löschen</button>
      <div id="dropdownDelPat" class="dropdown-content">
        <a href="./deletepat.php?selectedID=<?php echo $ID ?>">Sicher?</a>
      </div>
    </a>
    
    <a><button onclick="MenuPrint()" class="button">Drucken</button></a>

    <a><button onclick="MenuGoBack()" class="button">Zurück</button></a>
    
    <a><button onclick="MenuRefresh()" class="button">Aktualisieren</button></a>
    

    
  </div>


</body>

</html>