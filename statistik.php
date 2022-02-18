<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  header('Location: index.html');
  exit;
}
?>
<html>
<meta charset="utf-8">

<head>
  <title>Statistik</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="refresh" content="5" >
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
      <?php require("./incs/rights.inc.php"); if($usrpower >=8){echo "<a href='./adminpanel.php'>Einstellungen</a>";} ?>     
      <a href="./logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
  </nav>

  <div class="container">
  <div class="content">
    
<div>
<h2> Aktuelle Statistik</h2>
    <?php
   
    include("./incs/db_credentials.inc.php");
    $pdo = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name, $db_user, $db_password);

    $statement = $pdo->prepare("SELECT * FROM patienten WHERE anwesend = TRUE");
    $statement->execute(array());
    $anzahl_pat = $statement->rowCount();
    echo "<h3>Aktuelle Anzahl Patient:innen innerhalb BTP: $anzahl_pat </h3>";

    ?>
 
      
        <h4>Aktuelle Raumbelegung:</h4>



      <?php
 
      $con = new mysqli($db_host, $db_user, $db_password, $db_name);
      $sql = "SELECT name, capacity FROM rooms";
      $result = $con->query($sql);

      if ($result->num_rows > 0) {

          while ($row = $result->fetch_assoc()) {

  
            $statement = $pdo->prepare("SELECT * FROM patienten WHERE ort = ? AND anwesend = TRUE");
            $statement->execute(array($row["name"]));
      
      
            $anzahl_pat = $statement->rowCount();
            echo "" . $row["name"] . ": $anzahl_pat (Max: " . $row["capacity"] . ")<br>";
          }

          } else {
            echo ("Es wurden keine Räume gefunden!");
       }
      
      
      ?>


        
</div>
<div class="content">
       
            <h2>Gesamte Statistik</h2>

          <h4>Genutzte Transportmittel:</h4>
  
 

        <?php
      $con = new mysqli($db_host, $db_user, $db_password, $db_name);
      $sql = "SELECT tmittelname FROM transportmittel";
      $result = $con->query($sql);
      
      if ($result->num_rows > 0) {

          while ($row = $result->fetch_assoc()) {


            $statement = $pdo->prepare("SELECT * FROM patienten WHERE Tmittel = ? ");
            $statement->execute(array($row["tmittelname"]));
      
      
            $anzahl_pat = $statement->rowCount();
            echo "" . $row["tmittelname"] . ": $anzahl_pat <br>";
          }

          } else {
            echo ("Es wurden keine Transportmittel gefunden!");
       }
        ?>

<?php
include("./incs/db_credentials.inc.php");
$pdo = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name, $db_user, $db_password);

$statement = $pdo->prepare("SELECT * FROM patienten");
$statement->execute(array());
$anzahl_pat = $statement->rowCount();
echo "<h3>Anzahl registrierter Patient:innen insgesamt: $anzahl_pat </h3>";
?>
        
</div>
  </div>
</body>

</html>
