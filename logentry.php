<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;

}
require("./incs/rights.inc.php");
include ('./incs/db_credentials.inc.php');


  if ($usrpower == 1) {
	
    header("Location: ./statistik.php");
  }
  if (isset($_POST["logentry"]) && $usrpower >= 3) {
    $con = new mysqli($db_host, $db_user, $db_password, $db_name); 
    $ID = $_GET["selectedID"];

    if (!empty($_POST["logentry"])) {
      
      $LogEntry = filter_input(INPUT_POST, 'logentry');
      $sql = "INSERT INTO patlog (Event,PatID) values ('$LogEntry','$ID')";

      $con->query($sql);
      

    }
    mysqli_close($con);
    header("Location: ./patinfo.php?selectedID=$ID");
  }


?>

<script>  
var js_usropwer = <?php echo $usrpower ?>;

    if(js_usropwer <=3){
      alert("Du hast leider nicht genügend Rechte!");
      window.history.back();

    }

    function MenuGoBack(){
    window.location.href = "./tabelle.php";
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
			<?php if($usrpower >=8){echo "<a href='./adminpanel.php'>Einstellungen</a>";} ?>
			<a href="./logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</div>
  </nav>
  <?php $ID = $_GET["selectedID"];?>
    <div class="container">
      <h1>Eintrag erstellen</h1>

        <form action = "logentry.php?selectedID=<?php echo $ID ?>" method="POST">
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