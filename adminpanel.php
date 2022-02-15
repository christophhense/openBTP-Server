<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
    
}
require("./incs/rights.php");
  if ($usrpower == 1) {
	
    header("Location: ./statistik.php");
  }
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>BTP_Server</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="./fa/css/all.css">

</head>
<?php
	require('./incs/rights.php');

    if($usrpower < 9) {
        header("Location: ./home.php");
    }

?>
<script>

    
</script>

<body class="loggedin">
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
    <div class="containter">
		<div class="content">
			<h2>Adminpanel</h2>
			<div>
                <h3>Benutzerverwaltung</h3>

               <?php 
                
                    if(isset($_GET["del"]) && $usrpower >= 9){
                       
                        if(!empty($_GET["del"])){
                            include ('./incs/db_credentials.inc.php');
                            $con = new mysqli($db_host, $db_user, $db_password, $db_name); 
                            $ID = $_GET["del"];


                            $sql = "DELETE FROM accounts WHERE id = ?";
                            $statement = $con->prepare($sql);
                            $statement->bind_param('i', $ID);
                            
                            $statement->execute();


                            
                            mysqli_close($con);
                            
                                header("Location: ./adminpanel.php");
                        }
                    }

                    


                ?>

				<table>
                   
                <?php

                    include("./incs/db_credentials.inc.php");
                    $con = new mysqli($db_host, $db_user, $db_password, $db_name);

                    if (mysqli_connect_error()) {
                      die('Connect Error (' . mysqli_connect_errno() . ') '
                        . mysqli_connect_error());
                    }

                    $sql = "SELECT id, username, email, power FROM accounts";
                    $result = $con->query($sql);
                    
                    if ($result->num_rows > 0) {
                        
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["username"] . "</td><td>" . $row["email"] . "</td>
                            
                            <td>"?><a href="adminpanel.php?edit=<?php echo $row["id"] ?>"><i class="fas fa-edit"></i></a><a href="adminpanel.php?del=<?php echo $row["id"] ?>"><i class="fas fa-user-minus"></i></a><?php echo"</td>";

                        }
                        echo "</table>";

                    }
                    $con->close();

                ?>


				</table>
                <p>
                <h1>Neuen Benutzer erstellen</h1>
			<form action="registersend.php" method="post" autocomplete="off">
            <div class="row">
 
            <div class="col-25">
				<input type="text" name="username" placeholder="Benutzername" id="username" required>
                </div>
          </div>
          <div class="row">

            <div class="col-25">
				<input type="text" name="password" placeholder="Password" id="password" required>
                </div>
          </div>
          <div class="row">

            <div class="col-25">
				<input type="text" name="email" placeholder="E-Mail Adresse" id="email" required>
                </div>
          </div>
          <div class="row">

            <div class="col-25">
				<select name="power" id="power" required>
                  <option value="1">Statistik</option>
                  <option value="2">Sichter</option>
                  <option value="3">RegDesk</option>
                  <option value="8">Verwaltung</option>
                  <option value="9">Administrator</option>
				</select>
                </div>
          </div>
                <div class="row">
                
                <input type="submit" value="Erstellen">
           
                </div>
          </div>
          
			</form>
                
			</div>
            
            
		</div>
  </div>
            
</body>
</html>