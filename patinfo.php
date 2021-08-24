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

  <title>Patientendaten</title>
  <meta content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<script>
  function MenuCheckOut() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const selectedID = urlParams.get('selectedID')
    window.location.href = "clockout.php?selectedID=" + selectedID;

  }

  function MenuPrint() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const selectedID = urlParams.get('selectedID')
    window.location.href = "printpatdata.php?selectedID=" + selectedID;
  }

  function MenuRefresh() {
    location.reload();
  }
  function MenuGoBack(){
    window.history.back();
  }

  function extendDropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
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
    document.getElementById("myDropdown2").classList.toggle("show");
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
      <a href="/home.php">Startseite</a>
			<a href="/eingabe.php">Neuer Patient</a>
			<a href="/tabelle.php">Übersicht Patienten</a>
			<a href="/statistik.php">Statistik</a>
			<a href="/lageinfos.php">Lageinfos</a>
			<a href="/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</div>
  </nav>



<div class="container">
  <?php

  include('dbConfig.php');
  $ID = $_GET["selectedID"];

  $sql = "SELECT * FROM patienten WHERE ID = $ID";
  $result = mysqli_query($con, $sql);
  echo "<br>";

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
    Zugewiesener Aufenthaltsraum: " . $row["ort"] . "<br>
    Bemerkungen: " . $row["bemerkungen"] . "<br>
    Zeitstempel Regristatur: " . $row["eingang"] . "<br>
    Zeitstempel Ausgang: " . $row["ausgang"] . "<p>";
  }



  ?>
</div>
  <div>
    
    <a> <button onclick="MenuCheckOut()" class="button">Ausstempeln</button> </a>
    
    <a class="dropdown">
      <button onclick="extendDropdown()" class="dropbtn">Aufenthaltsraum ändern</button>
      <div id="myDropdown" class="dropdown-content">
        <a href="/changeroom.php?selectedID=<? echo $ID ?>&room=Aula">Aula</a>
        <a href="/changeroom.php?selectedID=<? echo $ID ?>&room=Sporthalle">Sporthalle</a>
        <a href="/changeroom.php?selectedID=<? echo $ID ?>&room=Turnhalle1">Turnhalle 1</a>
        <a href="/changeroom.php?selectedID=<? echo $ID ?>&room=Turnhalle2">Turnhalle 2</a>
        <a href="/changeroom.php?selectedID=<? echo $ID ?>&room=Turnhalle3">Turnhalle 3</a>
        <a href="/changeroom.php?selectedID=<? echo $ID ?>&room=SanBereich">SanBereich</a>
      </div>
</a>
    
    
    <a class="dropdown">
      <button onclick="extendDropdown2()" class="dropbtn">Patient löschen</button>
      <div id="myDropdown2" class="dropdown-content">
        <a href="/deletepat.php?selectedID=<?php echo $ID ?>">Sicher?</a>
      </div>
</a>
    
    
    <a><button onclick="MenuPrint()" class="button">Drucken</button></a>

    <a><button onclick="MenuGoBack()" class="button">Zurück</button></a>
    
    <a><button onclick="MenuRefresh()" class="button">Aktualisieren</button></a>
    

    
  </div>


</body>

</html>