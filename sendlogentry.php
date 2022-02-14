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
$LogEntry = filter_input(INPUT_POST, 'logentry');


$sql = "INSERT INTO patlog (Event,PatID) values ('$LogEntry','$ID')";

$con->query($sql);
mysqli_close($con);




?>

<script>history.back()</script>