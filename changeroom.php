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

$sql = "UPDATE patienten SET ort = ? WHERE ID = '$ID'";
$statement = $con->prepare($sql);
$statement->bind_param('s', $room);
 
$statement->execute();



if (mysqli_query($con, $sql)) {
    echo "Room updated successfully";
  } else {
    echo "Error updating record: " . mysqli_error($con);
  }
  
  mysqli_close($con);


?>
<meta http-equiv="refresh" content="0; url=tabelle.php">