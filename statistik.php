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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<body>

  <nav class="navtop">
    <div>
      <h1>BTP-Server</h1>
      <a href="./home.php">Startseite</a>
      <a href="./eingabe.php">Neuer Patient</a>
      <a href="./tabelle.php">Übersicht Patient:innen</a>
      <a href="./statistik.php">Statistik</a>
      <a href="./lageinfos.php">Lageinfos</a>
      <a href="./logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
  </nav>

  <div class="container">
    <h2> Aktuelle Statistik</h2>

    <?php
   
    include("./incs/db_credentials.inc.php");
    $pdo = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name, $db_user, $db_password);;

    $statement = $pdo->prepare("SELECT * FROM patienten WHERE ausgang <= CURDATE()");
    $statement->execute(array());
    $anzahl_pat = $statement->rowCount();
    echo "<h3>Aktuelle Anzahl Patient:innen innerhalb BTP: $anzahl_pat </h3>";

    ?>
    <div>
      <div>
        <p>
        <h4>Aktuelle Raumbelegung:</h4>
        </p>
      </div>

      <?php
      
      include("./incs/db_credentials.inc.php");
      $pdo = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name, $db_user, $db_password);

      $statement = $pdo->prepare("SELECT * FROM patienten WHERE ort = ? AND ausgang <= CURDATE()");
      $statement->execute(array('Aula'));
      $anzahl_pat = $statement->rowCount();
      echo "<p>Aula: $anzahl_pat </p>";

      $statement = $pdo->prepare("SELECT * FROM patienten WHERE ort = ? AND ausgang <= CURDATE()");
      $statement->execute(array('Sporthalle'));
      $anzahl_pat = $statement->rowCount();
      echo "<p>Sporthalle: $anzahl_pat </p>";

      $statement = $pdo->prepare("SELECT * FROM patienten WHERE ort = ? AND ausgang <= CURDATE()");
      $statement->execute(array('Turnhalle1'));
      $anzahl_pat = $statement->rowCount();
      echo "<p>Turnhalle 1: $anzahl_pat </p>";

      $statement = $pdo->prepare("SELECT * FROM patienten WHERE ort = ? AND ausgang <= CURDATE()");
      $statement->execute(array('Turnhalle2'));
      $anzahl_pat = $statement->rowCount();
      echo "<p>Turnhalle 2: $anzahl_pat </p>";

      $statement = $pdo->prepare("SELECT * FROM patienten WHERE ort = ? AND ausgang <= CURDATE()");
      $statement->execute(array('Turnhalle3'));
      $anzahl_pat = $statement->rowCount();
      echo "<p>Turnhalle 3: $anzahl_pat </p>";

      $statement = $pdo->prepare("SELECT * FROM patienten WHERE ort = ? AND ausgang <= CURDATE()");
      $statement->execute(array('SanBereich'));
      $anzahl_pat = $statement->rowCount();
      echo "<p>San Bereich: $anzahl_pat </p>";

      ?>

      <div>
        <div>
          <p>
            <h3>Gesamte Statistik</h3>
            <p>
          <h4>Transportmittel:</h4>
          </p>
        </div>

        <?php
        include("./incs/db_credentials.inc.php");
        $pdo = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name, $db_user, $db_password);

        $statement = $pdo->prepare("SELECT * FROM patienten WHERE TMittel = ?");
        $statement->execute(array('RTW'));
        $anzahl_pat = $statement->rowCount();
        echo "<p>RTW: $anzahl_pat </p>";

        $statement = $pdo->prepare("SELECT * FROM patienten WHERE TMittel = ?");
        $statement->execute(array('KTW'));
        $anzahl_pat = $statement->rowCount();
        echo "<p>KTW: $anzahl_pat </p>";

        $statement = $pdo->prepare("SELECT * FROM patienten WHERE TMittel = ?");
        $statement->execute(array('keinRD'));
        $anzahl_pat = $statement->rowCount();
        echo "<p>LMW / Taxi / Privatunternehmen / DSW21: $anzahl_pat </p>";

        $statement = $pdo->prepare("SELECT * FROM patienten WHERE TMittel = ?");
        $statement->execute(array('selbst'));
        $anzahl_pat = $statement->rowCount();
        echo "<p>Eigenständig: $anzahl_pat </p>";


        ?>
<?php
include("./incs/db_credentials.inc.php");
$pdo = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name, $db_user, $db_password);

$statement = $pdo->prepare("SELECT * FROM patienten");
$statement->execute(array());
$anzahl_pat = $statement->rowCount();
echo "<h3>Anzahl registrierter Patient:innen insgesamt: $anzahl_pat </h3> </p>";
?>
      </div>
    </div>


</body>

</html>
