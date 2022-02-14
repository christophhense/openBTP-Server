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

  <title>Einsatzende</title>
  <meta content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

</head>
<body>

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
    </thead>


    <?php

    include("./incs/db_credentials.inc.php");
    $con = new mysqli($db_host, $db_user, $db_password, $db_name);

    if (mysqli_connect_error()) {
      die('Connect Error (' . mysqli_connect_errno() . ') '
        . mysqli_connect_error());
    }
    $sql = "SELECT id, vorname, nachname, geburtsdatum FROM patienten";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      // output
      while ($row = $result->fetch_assoc()) {
        echo "<tr><td class='patID'>" . $row["id"] . "</td><td>" . $row["vorname"] . "</td><td>" . $row["nachname"] . "</td><td>"
          . $row["geburtsdatum"] . "
</tr>";
      }
      echo "</table>";
    } else {
      echo "Keine Patient:innen in Datenbank";
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
    
    const patId = row.querySelector(".patID").innerText;
    window.location.href = "./clockout.php?selectedID=" + patId;
  });
});

</script>


</html>