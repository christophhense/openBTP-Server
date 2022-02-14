


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


$sql = "UPDATE patienten SET ausgang = now() WHERE id = ?";
$statement = $con->prepare($sql);
$statement->bind_param('i', $ID );
 
$statement->execute();

$sql = "UPDATE patienten SET anwesend = FALSE WHERE ID = ? ";
$statement = $con->prepare($sql);
$statement->bind_param('i',$ID);
$statement->execute();

$sql = "INSERT INTO patlog (Event,PatID) values ('Patient ausgestempelt','$ID')";

$con->query($sql);
mysqli_close($con);

echo '<script type="text/javascript">',
     'window.history.back();',
     '</script>'


?>

