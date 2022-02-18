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
?>
<!DOCTYPE html>
<html>

<head>

    <title>Übersicht Abschnitt Sanität</title>
    <meta content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="5" >
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./fa/css/all.css">

</head>

<body>
    <script>
    
    function MenuRefresh() {
    location.reload();
    }

    function CloseWindow() {
    window.close();
    }

  </script>


    <nav class="navtop">
        <div>
            <h1>BTP-Server</h1>
            <h1>Übersicht Sanität</h1>
            <a onclick="MenuRefresh()">Aktualisieren</a>
            <a onclick="CloseWindow()">Schließen</a>

            
        </div>
    </nav>
    <script src="./main.js"></script>
    <div class="container">
        <table class="table" id="patienten">
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
                        <input type="text" class="search-input" placeholder="Raum">
                    </th>

            </thead>


            <?php

            include("./incs/db_credentials.inc.php");
            $con = new mysqli($db_host, $db_user, $db_password, $db_name); 
           


            if (mysqli_connect_error()) {
                die('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
            }

            $sql_san = "SELECT name FROM rooms WHERE isSan = TRUE";
            $result_san = $con->query($sql_san);
           
            
            if ($result_san->num_rows > 0) {

                while ($row_san = $result_san->fetch_assoc()) {

            $sql = "SELECT id, vorname, nachname, geburtsdatum, adresse, telefon, erkrankungen, medis, medisgenug, material, TMittel, mobility, bemerkungen, ort FROM patienten WHERE ort = ? AND anwesend = TRUE";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('s', $row_san["name"]);
            $stmt->execute();
            $result = $stmt->get_result();
     
           
            if ($result->num_rows > 0) {
                // output
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td class = 'patID'>" . $row["id"] . "</td><td>" . $row["vorname"] . "</td><td>" . $row["nachname"] . "</td><td>"
                        . $row["geburtsdatum"] . "</td><td>" . $row["adresse"] . "</td><td>" . $row["telefon"] . "</td><td>" . $row["erkrankungen"] . "</td><td>" . $row["medis"] . "</td><td>" . $row["medisgenug"] . "</td><td>" . $row["material"] . "</td><td>" . $row["TMittel"] . "</td><td>" . $row["mobility"] . "</td><td>" . $row["ort"] . "</td></tr>";
                }
                echo "</table>";
            } 
        }
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
            window.location.href = "patinfo.php?selectedID=" + patId  + "&sanbereich=TRUE";
        });
    });
</script>


</html>