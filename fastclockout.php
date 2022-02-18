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

if (isset($_GET['checkout'])) {
  if ($usrpower >= 3){
  checkout($db_host, $db_user, $db_password, $db_name, $_GET["selectedID"]);

  echo ('<script>history.back()</script>');
  } else {
    echo ('<script>alert("Du hast nicht genügend Bereichtigungen!")</script>')
    ;
  }
  

}
?>
<!DOCTYPE html>
<html>

<head>

  <title>Einsatzende</title>
  <meta content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="./fa/css/all.css">

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
    if ($usrpower >= 3){
    include("./incs/db_credentials.inc.php");
    $con = new mysqli($db_host, $db_user, $db_password, $db_name);

    if (mysqli_connect_error()) {
      die('Connect Error (' . mysqli_connect_errno() . ') '
        . mysqli_connect_error());
    }
    $sql = "SELECT id, vorname, nachname, geburtsdatum FROM patienten WHERE anwesend = 1";
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
  } else {
      echo "<script>window.close();</script>";
        } 
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
    window.location.href = "./fastclockout.php?selectedID=" + patId + "&checkout";
  });
});

</script>


</html>