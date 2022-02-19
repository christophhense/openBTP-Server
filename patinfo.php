<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;

  
}
require("./incs/rights.inc.php");
  if ($usrpower == 1) {
    header("Location: ./statistik.php");
  }
include("./incs/functions.inc.php");



if (isset($_GET['del'])) {

  if($usrpower >= 3){
  deletePatient($db_host, $db_user, $db_password, $db_name, $_GET["selectedID"]);
  }
  header("Location: ./tabelle.php");
}
if (isset($_GET['room'])) {
  if($usrpower >= 3){

  changeRoom($db_host, $db_user, $db_password, $db_name, $_GET["selectedID"], $_GET["room"]);
  }

  echo ('<script>history.back()</script>');
  

}
if (isset($_GET['checkin'])) {
  if($usrpower >= 3){

  checkin($db_host, $db_user, $db_password, $db_name, $_GET["selectedID"]);
  }

  echo ('<script>history.back()</script>');
  

}
if (isset($_GET['checkout'])) {
  if($usrpower >= 3){

  checkout($db_host, $db_user, $db_password, $db_name, $_GET["selectedID"]);
  }

  echo ('<script>history.back()</script>');

  

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
    var js_usropwer = <?php echo $usrpower ?>;
		if (js_usropwer >= 3) {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const selectedID = urlParams.get('selectedID')
    window.location.href = "patinfo.php?selectedID=" + selectedID + "&checkout";
  } else {
			alert("Du hast leider nicht genügend Rechte!")
		}

  }
  function MenuCheckIn() {
    var js_usropwer = <?php echo $usrpower ?>;
		if (js_usropwer >= 3) {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const selectedID = urlParams.get('selectedID')
    window.location.href = "patinfo.php?selectedID=" + selectedID + "&checkin";
  } else {
			alert("Du hast leider nicht genügend Rechte!")
		}

  }

  function MenuLogEntry(){
    var js_usropwer = <?php echo $usrpower ?>;
		if (js_usropwer >= 3) {

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const selectedID = urlParams.get('selectedID')
    const sanbereich = urlParams.get('sanbereich');
    if (sanbereich == "1"){
    window.location.href = ("logentry.php?selectedID=" + selectedID + "&sanbereich=1");
    }else{
      window.location.href = ("logentry.php?selectedID=" + selectedID);
    }
  } else {
			alert("Du hast leider nicht genügend Rechte!")
		}

  
  }

  function MenuPrint() {

    var js_usropwer = <?php echo $usrpower ?>;
		if (js_usropwer >= 2) {
      
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const selectedID = urlParams.get('selectedID')
    window.open("printpatdata.php?selectedID=" + selectedID, "_blank", "toolbar=no,scrollbars=yes,resizable=yes,");
		

		} else {
			alert("Du hast leider nicht genügend Rechte!")
		}

	
  }

  function MenuRefresh() {
    location.reload();
  }
  function MenuGoBack(){
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const sanbereich = urlParams.get('sanbereich');

    if (sanbereich == "1"){

      window.location.href = "./sanbereich.php";
      
    } else {
      window.location.href = "./tabelle.php";

    }


  }

  function extendDropdown() {
    var js_usropwer = <?php echo $usrpower ?>;
		if (js_usropwer >= 3) {
    document.getElementById("dropdownChangeRoom").classList.toggle("show");
  
  }else {
			alert("Du hast leider nicht genügend Rechte!")
  }
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
    var js_usropwer = <?php echo $usrpower ?>;
		if (js_usropwer >= 8) {

    document.getElementById("dropdownDelPat").classList.toggle("show");
  }else {
			alert("Du hast leider nicht genügend Rechte!")
  }
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
			<?php if($usrpower >=8){echo "<a href='./adminpanel.php'>Einstellungen</a>";} ?>
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
     <?php include("./incs/db_credentials.inc.php");
    $con = new mysqli($db_host, $db_user, $db_password, $db_name);

    if (mysqli_connect_error()) {
      die('Connect Error (' . mysqli_connect_errno() . ') '
        . mysqli_connect_error());
    }
    $sql = "SELECT name FROM rooms";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      // output
      while ($row = $result->fetch_assoc()) {

          echo"<a href='./patinfo.php?selectedID=" . $ID . "&room=" . $row["name"] . "'>" . $row["name"] . "</a>";


      }
    }
      $con->close();
        ?>
       
      </div>
    </a>

    <a><button onclick="MenuLogEntry()" class="button">Eintrag erstellen</button></a>

    <a> <button onclick="MenuCheckIn()" class="button">Check-In</button> </a>

    <a> <button onclick="MenuCheckOut()" class="button">Check-Out</button> </a>
      
    <a class="dropdown">
      <button onclick="extendDropdown2()" class="dropbtn">Patient löschen</button>
      <div id="dropdownDelPat" class="dropdown-content">
        <a href ="./patinfo.php?selectedID=<?php echo $ID ?>&del=true">Sicher?</a>
      </div>
    </a>
    
    <a><button onclick="MenuPrint()" class="button">Drucken</button></a>

    <a><button onclick="MenuGoBack()" class="button">Zurück</button></a>
    
    <a><button onclick="MenuRefresh()" class="button">Aktualisieren</button></a>
    

    
  </div>


</body>

</html>