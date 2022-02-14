<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<?php

include ('./incs/db_credentials.inc.php');
$con = new mysqli($db_host, $db_user, $db_password, $db_name); 

$ID = $_GET["selectedID"];
$room = $_GET["room"];

$sql = "UPDATE patienten SET ort = ? WHERE ID = ? ";
$statement = $con->prepare($sql);
$statement->bind_param('si', $room, $ID);
 
$statement->execute();

 mysqli_close($con);


?>
<meta http-equiv="refresh" content="0; url=./tabelle.php">