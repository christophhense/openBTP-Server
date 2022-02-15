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
<?php
	require('./incs/rights.php');

    if($usrpower < 9) {
        header("Location: ./home.php");
    }

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BTP Server</title>
		<link rel="stylesheet" href="./fa/css/all.css">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div>
			<h1>Neuen Benutzer erstellen</h1>
			<form action="registersend.php" method="post" autocomplete="off">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<label for="email">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="Email" id="email" required>
				
				<select name="power" id="power" required>
                  <option value="1">Statistik</option>
                  <option value="2">Sichter</option>
                  <option value="3">RegDesk</option>
                  <option value="8">Verwaltung</option>
                  <option value="9">Administrator</option>
				
				<input type="submit" value="Erstellen">

			</form>
		</div>
	</body>
</html>