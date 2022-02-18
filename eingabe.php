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
  if ($usrpower <=2) {
    header("Location: ./home.php");
  }


  if (isset($_GET["error"])) {
                    if (!empty($_GET["error"])) {
                      switch($_GET["error"]){

                        case "nofirstname":
                          echo"<script>alert('Kein Vorname eingetragen');</script>";
                        case "noname":
                          echo"<script>alert('Kein Nachnamen eingetragen');</script>";
                        case "nobirthday":
                          echo"<script>alert('Kein Geburtsdatum eingetragen');</script>";
                        case "noadress":
                          echo"<script>alert('Keine Adresse eingetragen');</script>";
                        case "nocap":
                          echo"<script>alert('Der gewählte Raum hat keine Kapazität mehr');</script>";

                      }

                    }
                }
                ?>
<html>
  <meta charset="utf-8" >
  <head>
    <title>Neuer Patient</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./fa/css/all.css">
    </head>
    
<body>

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
      if (isset($_GET["success"])) {
                 echo("Patient erfolgreich eingetragen!");
      }?>
      <h1>Neuer Patient</h1>
      <h3>vollständig ausfüllen!</h3>
     

        <form action = "connect.php" method="POST">
          <div class="row">
            <div class="col-25">
              <label for="vorname">Vorname</label>
            </div>
            <div class="col-75">
              <input type="text" id="vorname" name="vorname" placeholder="Vorname Patient">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="nachname">Nachname</label>
            </div>
            <div class="col-75">
              <input type="text" id="nachname" name="nachname" placeholder="Nachname Patient">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="geburtsdatum">Geburtsdatum</label>
            </div>
            <div class="col-75">
                <input type = "date" name = "geburtsdatum" placeholder="TT.MM.JJJJ" />
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="adresse">Adresse</label>
            </div>
            <div class="col-75">
              <textarea id="adresse" name="adresse" placeholder="Adresse" style="height:90px"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="telefon">Telefonnummer</label>
            </div>
            <div class="col-75">
                <input type="text" id="telefon" name="telefon" placeholder="Telefonnummer Patient">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="erkrankungen">Vorerkrankungen</label>
            </div>
            <div class="col-75">
                <input type="text" id="erkrankungen" name="erkrankungen" placeholder="Liste aller Vorerkrankungen" style="height:130px">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="medis">Medikamente</label>
            </div>
            <div class="col-75">
                <input type="text" id="medis" name="medis" placeholder="Liste aller Medikamente" style="height:130px">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="medisgenug">Ausreichend Medikamente?</label>
            </div>
            <div class="col-75">
                <input type="checkbox" id="medisgenug" name="medisgenug" value="ja">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="material">Benötigtes Material</label>
            </div>
            <div class="col-75">
                <input type="text" id="material" name="material" placeholder="Besonderes Material wie Sauerstoff benötigt?" style="height:130px">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="TMittel">Transportmittel Ankunft</label>
            </div>
            <div class="col-75">
              <select id="TMittel" name="TMittel">
              <?php
                    include("./incs/db_credentials.inc.php");
                    $con = new mysqli($db_host, $db_user, $db_password, $db_name);
                
                    if (mysqli_connect_error()) {
                      die('Connect Error (' . mysqli_connect_errno() . ') '
                        . mysqli_connect_error());
                    }
                    $sql = "SELECT tmittelname FROM transportmittel";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                      // output
                      while ($row = $result->fetch_assoc()) {

                        echo"<option value='" . $row["tmittelname"] . "'>". $row["tmittelname"] . "</option>";

                      }

                    }
                  ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="mobility">Mobilität</label>
            </div>
            <div class="col-75">
              <select id="mobility" name="mobility">
                <option value="Laufend">Laufend</option>
                <option value="Rollstuhl">Rollstuhl</option>
                <option value="Rollator">Rollator</option>
                <option value="Liegend">Liegend</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="bemerkungen">Bemerkungen</label>
            </div>
            <div class="col-75">
                <input type="text" id="bemerkungen" name="bemerkungen" placeholder="weitere Bemerkungen ggf. Funkkennung des Transportmittel bzw Rufnummer Rücktransport" style="height:130px">
            </div>
            <div class="row">
              <div class="col-25">
                <label for="ort">Zugewiesener Aufenthaltsraum</label>
              </div>
              <div class="col-75">
                <select id="ort" name="ort">
                  <?php
                    include("./incs/db_credentials.inc.php");
                    $con = new mysqli($db_host, $db_user, $db_password, $db_name);
                    $pdo = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name, $db_user, $db_password);
                
                    if (mysqli_connect_error()) {
                      die('Connect Error (' . mysqli_connect_errno() . ') '
                        . mysqli_connect_error());
                    }
                    $sql = "SELECT name, capacity FROM rooms";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                      
                      // output
                      while ($row = $result->fetch_assoc()) {

                        $statement = $pdo->prepare("SELECT * FROM patienten WHERE ort = ? AND anwesend = TRUE");
                        $statement->execute(array($row["name"]));
                        $anzahl_pat = $statement->rowCount();

                        echo"<option value='" . $row["name"] . "'>". $row["name"] . " (" . $anzahl_pat . " / " . $row["capacity"] . ")</option>";

                      }

                    }

                    $pdo = null;
                    $con->close();
                  ?>
                
                </select>
              </div>
            </div>

          
          <div class="row">
            <p></p>
            <input type="submit" value="Patienten eintragen">
          </div>
        </form>
        <div>
          <p>Inhaltliche Fragen: an GF Betreuung wenden</p>
          <p>Technische Probleme oder Fragen an den ELW wenden</p>
          
          
        </div>
      </div>
</body>