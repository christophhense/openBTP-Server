<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<?php

include ('dbConfig.php');
$ID = $_GET["selectedID"];


$sql = "UPDATE patienten SET ausgang = now() WHERE id = $ID";
$statement = $con->prepare($sql);
$statement->bind_param('ssi', $id);
 
$statement->execute();



if (mysqli_query($con, $sql)) {
    echo "Patient status updated";
  } else {
    echo "Error updating patient: " . mysqli_error($con);
  }
  
  mysqli_close($con);


?>
<meta http-equiv="refresh" content="0; url=tabelle.php">