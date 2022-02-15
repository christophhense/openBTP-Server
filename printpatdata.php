<?php
require("./incs/rights.php");
if ($usrpower >= 2) {


  include('./incs/db_credentials.inc.php');
  $con = new mysqli($db_host, $db_user, $db_password, $db_name); 
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
    Zeitstempel Ausgang: " . $row["ausgang"] . "<p></tr>";
  }
$sql = "SELECT EventID, Event, timestamp FROM patlog WHERE PatID = $ID";
$result = mysqli_query($con, $sql);
echo "
<br>
<p><h3>Verlauf:</h3></p>
<table>
<tr><th>Uhrzeit</th>
<th>Eintrag</th></tr>
";
while ($row = mysqli_fetch_assoc($result)) {

echo "<tr><td>"  . $row["timestamp"] . " :</td><td> " . $row["Event"] . "</td></tr>";

}
echo"</table>";
}
  ?>
  
  
  <script>
window.print();
 setTimeout(window.close, 500);

  </script>

