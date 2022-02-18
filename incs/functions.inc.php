<?php
function getAuslastung($db_host, $db_name,$db_password,$db_user,$ort){


$con = new mysqli($db_host, $db_user, $db_password, $db_name);
$pdo = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name, $db_user, $db_password);

      $sql = "SELECT * FROM `rooms` WHERE name = '$ort'";
      $result = $con->query($sql);


      if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {


          $statement = $pdo->prepare("SELECT * FROM patienten WHERE ort = ? AND anwesend = TRUE");
          $statement->execute(array($row["name"]));
          $auslastung = $statement->rowCount();
        $cap = $row["capacity"];

        if($cap > $auslastung){

            
            return False;


        } else {
            return True;
        }
      

        }

        } else {
          
          header('Location: ./eingabe.php?error=noroom');
     }


    
    
}
function deletePatient ($db_host, $db_user, $db_password, $db_name, $ID){

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
    }

function changeRoom ($db_host, $db_user, $db_password, $db_name, $ID, $room) {

    $con = new mysqli($db_host, $db_user, $db_password, $db_name); 
    

    $sql = "UPDATE patienten SET ort = ? WHERE ID = ? ";
    $statement = $con->prepare($sql);
    $statement->bind_param('si', $room, $ID);
     
    $statement->execute();
    $sql = "INSERT INTO patlog (Event,PatID) values ('Raum gewechselt zu $room','$ID')";
    
    $con->query($sql);
    
     mysqli_close($con);

}
function checkin ($db_host, $db_user, $db_password, $db_name, $ID){

$con = new mysqli($db_host, $db_user, $db_password, $db_name); 

$ID = $_GET["selectedID"];


$sql = "INSERT INTO patlog (Event,PatID) values ('Patient eingestempelt','$ID')";

$con->query($sql);

$sql = "UPDATE patienten SET anwesend = TRUE WHERE ID = ? ";
$statement = $con->prepare($sql);
$statement->bind_param('i',$ID);
$statement->execute();

mysqli_close($con);

echo '<script type="text/javascript">',
     'window.history.back();',
     '</script>';

    }
function checkout ($db_host, $db_user, $db_password, $db_name, $ID){

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
     '</script>';
  
      }


?>