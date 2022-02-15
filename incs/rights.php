<?php
	// Rechte abfragen
	include('./incs/db_credentials.inc.php');
	$con = new mysqli($db_host, $db_user, $db_password, $db_name);

    $sql = "SELECT power FROM accounts WHERE id = ?";
    $statement = $con->prepare($sql);
   	$statement->bind_param('i', $_SESSION['id']);
    $statement->execute();
	$statement->bind_result($usrpower);
   	$statement->fetch();
	mysqli_close($con);

?>