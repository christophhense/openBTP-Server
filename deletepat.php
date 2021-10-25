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


$sql = "DELETE FROM patienten WHERE ID = ?";
$statement = $con->prepare($sql);
$statement->bind_param('s', $ID);
 
$statement->execute();



if (mysqli_query($con, $sql)) {
    echo "Patient updated successfully";
  } else {
    echo "Error updating patient: " . mysqli_error($con);
  }
  
  mysqli_close($con);


?>
<meta http-equiv="refresh" content="0; url=tabelle.php">