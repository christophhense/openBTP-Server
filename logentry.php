<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<script>  
    function MenuGoBack(){
    window.history.back();
    }
</script>
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
			<a href="./tabelle.php">Übersicht Patient:in</a>
			<a href="./statistik.php">Statistik</a>
			<a href="./lageinfos.php">Lageinfos</a>
			<a href="./logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</div>
  </nav>
  <?php $ID = $_GET["selectedID"];?>
    <div class="container">
      <h1>Eintrag erstellen</h1>

        <form action = "sendlogentry.php?selectedID=<?php echo $ID ?>" method="POST">
          <div class="row">
            <div class="col-75">
                <input type="text" id="logentry" name="logentry" placeholder="Eintrag in den Patientenverlauf" style="height:130px">
                <input type="submit" value="Eintragen">
                
</div>

          </div>

          

            

        </form>
        <a><button onclick="MenuGoBack()" class="button">Zurück</button></a>
      </div>
</body>
</html>