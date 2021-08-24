<?php

  include('dbConfig.php');
  $ID = $_GET["selectedID"];

  $sql = "SELECT * FROM patienten WHERE ID = $ID";
  $result = mysqli_query($con, $sql);
  echo "<br>";

  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";

    echo "<p><h2>" . $row["nachname"] . ", " . $row["vorname"] . "</h2><br> 
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
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>

$(document).ready(() => { window.print()})
  </script>
<meta http-equiv="refresh" content="0; url=tabelle.php">
