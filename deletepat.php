<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<?php
require ('./incs/rights.php');

if ($usrpower >= 4 ){

include ('./incs/db_credentials.inc.php');
$con = new mysqli($db_host, $db_user, $db_password, $db_name); 
$ID = $_GET["selectedID"];


$sql = "DELETE FROM patlog WHERE PatID = ?";
$statement = $con->prepare($sql);
$statement->bind_param('i', $ID);
 
$statement->execute();

$sql = "DELETE FROM patienten WHERE ID = ?";
$statement = $con->prepare($sql);
$statement->bind_param('i', $ID);
 
$statement->execute();

 
mysqli_close($con);
}else{
	echo "<script>
		alert('Nicht genügend Rechte!');
	</script>";
}

?>
<meta http-equiv="refresh" content="0; url=./tabelle.php">