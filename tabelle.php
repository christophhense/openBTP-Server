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

  <title>Patientenübersicht</title>
  <meta content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

</head>
<body>


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
<script src="./main.js"></script>
  <div class="container">
  <table class ="table" id="patienten">
    <thead>
    <tr>
      <th>
        <input type="text" class="search-input" placeholder="ID">
      </th>
      <th>
        <input type="text" class="search-input" placeholder="Vorname">
      </th>
      <th>
        <input type="text" class="search-input" placeholder="Nachname">
      </th>
      <th>
        <input type="text" class="search-input" placeholder="Geburtsdatum">
      </th>
      <th>
        <input type="text" class="search-input" placeholder="Wohnanschrift">
      </th>
      <th>
        <input type="text" class="search-input" placeholder="Telefonnummer">
      </th>
      <th>
        <input type="text" class="search-input" placeholder="Vorerkrankungen">
      </th>
      <th>
        <input type="text" class="search-input" placeholder="Medikamente">
      </th>
      <th>
        <input type="text" class="search-input" placeholder="Ausreichend?">
      </th>
      <th>
        <input type="text" class="search-input" placeholder="Material">
      </th>
      <th>
        <input type="text" class="search-input" placeholder="Transportmittel">
      </th>
      <th>
        <input type="text" class="search-input" placeholder="Mobilität">
      </th>
      <th>
        <input type="text" class="search-input" placeholder="Bemerkungen">
      </th>
      <th>
        <input type="text" class="search-input" placeholder="Aufenthaltsort">
      </th>
      <th>
        <input type="text" class="search-input" placeholder="Zeit Eingang">
      </th>
    </thead>


    <?php

    include("./incs/db_credentials.inc.php");
    $con = new mysqli($db_host, $db_user, $db_password, $db_name);

    if (mysqli_connect_error()) {
      die('Connect Error (' . mysqli_connect_errno() . ') '
        . mysqli_connect_error());
    }
    $sql = "SELECT id, vorname, nachname, geburtsdatum, adresse, telefon, erkrankungen, medis, medisgenug, material, TMittel, mobility, bemerkungen, ort, eingang FROM patienten";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      // output
      while ($row = $result->fetch_assoc()) {
        echo "<tr><td class='patID'>" . $row["id"] . "</td><td>" . $row["vorname"] . "</td><td>" . $row["nachname"] . "</td><td>"
          . $row["geburtsdatum"] . "</td><td>" . $row["adresse"] . "</td><td>" . $row["telefon"] . "</td><td>" . $row["erkrankungen"] . "</td><td>" . $row["medis"] . "</td><td>" . $row["medisgenug"] . "</td><td>" . $row["material"] . "</td><td>" . $row["TMittel"] . "</td><td>" . $row["mobility"] . "</td><td>" . $row["bemerkungen"] . "</td><td>" . $row["ort"] . "</td><td>" . $row["eingang"] . "</td>
</tr>";
      }
      echo "</table>";
    } else {
      echo "Keine Patienten in Datenbank";
    }
    $con->close();
    ?>



    </div>

  </table>

  </div>

</body>

<script>

document.addEventListener("DOMContentLoaded", () => {
  const table = document.querySelector("#patienten");
  table.addEventListener("click", e => {
    const row = e.target.closest("tr");
    row.style.backgroundColor = "yellow";
    const patId = row.querySelector(".patID").innerText;
    window.location.href = "patinfo.php?selectedID=" + patId;
  });
});

</script>


</html>