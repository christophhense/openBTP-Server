<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
require("./incs/rights.inc.php");
if ($usrpower == 1) {

    header("Location: ./statistik.php");
}


if ($usrpower < 8) {
    header("Location: ./home.php");
}


if (isset($_POST["username"]) && $usrpower >= 9) {

    if (!empty($_POST["username"])) {
        include("./incs/db_credentials.inc.php");
        $con = new mysqli($db_host, $db_user, $db_password, $db_name);
        if (mysqli_connect_errno()) {
            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
        }
        if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
            exit('Bitte vollständig ausfüllen!');
        }
        if (empty($_POST['username']) || empty($_POST['password'])) {
            exit('Bitte vollständig ausfüllen!');
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            exit('Email nicht gültig');
        }
        if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
            exit('Username nicht gültig!');
        }
        if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            exit('Bitte ein PW zwischen 5 und 20 Zeichen nutzen!');
        }
        if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                echo 'Benutzername bereits vorhanden!';
            } else {
                if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email, power) VALUES (?, ?, ?, ?)')) {
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $stmt->bind_param('sssi', $_POST['username'], $password, $_POST['email'], $_POST['power']);
                    $stmt->execute();
                    header("Location: ./adminpanel.php");
                } else {
                    echo 'Could not prepare statement!';
                }
            }
            $stmt->close();
        } else {
            echo 'Could not prepare statement!';
        }
        $con->close();
    }
}


if (isset($_GET["del"]) && $usrpower >= 9) {
  

    if (!empty($_GET["del"])) {
        include('./incs/db_credentials.inc.php');
        $con = new mysqli($db_host, $db_user, $db_password, $db_name);
        $ID = $_GET["del"];

        $sql = "SELECT power FROM accounts where id = $ID";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $acc_pwr = $row["power"];
            }
        }
        if ($acc_pwr < 9){
        $sql = "DELETE FROM accounts WHERE id = ?";
        $statement = $con->prepare($sql);
        $statement->bind_param('i', $ID);

        $statement->execute();
        }


        $sql = "SELECT * FROM accounts WHERE power = 9";
        $result = mysqli_query($con, $sql);
        $countadmins = mysqli_num_rows( $result );

        if($countadmins != 1){

        $sql = "DELETE FROM accounts WHERE id = ?";
        $statement = $con->prepare($sql);
        $statement->bind_param('i', $ID);

        $statement->execute();

        }
    

        mysqli_close($con);

        header("Location: ./adminpanel.php");
    }
}
if (isset($_GET["name"]) && $usrpower >= 8) {

    if (!empty($_GET["name"])) {
        include('./incs/db_credentials.inc.php');
        $con = new mysqli($db_host, $db_user, $db_password, $db_name);
        $name = $_GET["name"];
        $capacity = $_GET["capacity"];
        if ($_GET["isSan"] == "on") {
            $isSan = true;
        } else {
            $isSan = false;
        }


        $stmt = $con->prepare('INSERT INTO rooms (name, capacity, isSan) VALUES (?, ?, ?)');
        $stmt->bind_param('sii', $name, $capacity, $isSan);
        $stmt->execute();

        mysqli_close($con);

        header("Location: ./adminpanel.php");
    }
}
if (isset($_GET["delroom"]) && $usrpower >= 8) {

    if (!empty($_GET["delroom"])) {
        include('./incs/db_credentials.inc.php');
        $con = new mysqli($db_host, $db_user, $db_password, $db_name);
        $ID = $_GET["delroom"];


        $sql = "DELETE FROM rooms WHERE id = ?";
        $statement = $con->prepare($sql);
        $statement->bind_param('i', $ID);

        $statement->execute();



        mysqli_close($con);

        header("Location: ./adminpanel.php");
    }
}
if (isset($_GET["tmittelname"]) && $usrpower >= 8) {

    if (!empty($_GET["tmittelname"])) {
        include('./incs/db_credentials.inc.php');
        $con = new mysqli($db_host, $db_user, $db_password, $db_name);


        $stmt = $con->prepare('INSERT INTO transportmittel (tmittelname) VALUES (?)');
        $stmt->bind_param('s', $_GET["tmittelname"]);
        $stmt->execute();

        mysqli_close($con);

        header("Location: ./adminpanel.php");
    }
}
if (isset($_GET["deltmittel"]) && $usrpower >= 8) {

    if (!empty($_GET["deltmittel"])) {
        include('./incs/db_credentials.inc.php');
        $con = new mysqli($db_host, $db_user, $db_password, $db_name);
        $name = $_GET["deltmittel"];


        $sql = "DELETE FROM transportmittel WHERE tmittelname = ?";
        $statement = $con->prepare($sql);
        $statement->bind_param('s', $name);

        $statement->execute();



        mysqli_close($con);

        header("Location: ./adminpanel.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>openBTP-Server</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./fa/css/all.css">
    <style>
        th.th-admin {
            color: #2A496E;
            text-align: left;
            font-weight: bold;
            background-color: #ffff;
        }
        input[type=password], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }
    </style>

</head>

<body class="loggedin">
    <nav class="navtop">
        <div>
            <h1>BTP-Server</h1>
            <a href="./home.php">Startseite</a>
            <a href="./eingabe.php">Neuer Patient</a>
            <a href="./tabelle.php">Übersicht Patient:innen</a>
            <a href="./statistik.php">Statistik</a>
            <?php if($usrpower >=8){echo "<a href='./adminpanel.php'>Einstellungen</a>";} ?>
            <a href="./logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>
    <div class="containter">
        <div class="content">
            <h2>Stammdaten</h2>
            <div>
          <?php  if (isset($_GET["first_start"]) && $usrpower >= 9) {
                    if (!empty($_GET["first_start"])) {

                    
                    echo "<div><p>
                    <h2>Infos Erster Start</h2><br>
                    Folgende ersten Schritte sind zu empfehlen: <br>
                    1. Alle für den Einsatz vorgesehenen Benutzer:innen erstellen und im Anschluss den btpuser löschen (erneut anmelden)<br>
                    2. Alle Räume anlegen<br>
                    3. Alle Transportmittel anlegen<br>
                    
                </p></div>";
                    }
                }
                ?>
                
                <p>
                <h2>Benutzerverwaltung</h2>
                <?php if ($usrpower < 9) echo " <h3>Unzureichende Bereichtigungen</h3>"; ?>
                <div <?php if ($usrpower < 9) echo " style='display: none';"; ?> >

                <table>

                    <?php

                    include("./incs/db_credentials.inc.php");
                    $con = new mysqli($db_host, $db_user, $db_password, $db_name);

                    if (mysqli_connect_error()) {
                        die('Connect Error (' . mysqli_connect_errno() . ') '
                            . mysqli_connect_error());
                    }

                    $sql = "SELECT id, username, email, power FROM accounts";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {

                            switch ($row["power"]) {
                                case 1:
                                    $role = "Statistik";
                                    break;
                                case 2:
                                    $role = "Sichter";
                                    break;
                                case 3:
                                    $role = "RegDesk";
                                    break;
                                case 8:
                                    $role = "Verwaltung";
                                    break;
                                case 9:
                                    $role = "Administration";
                                    break;
                            }
                            echo "<tr><td>" . $row["username"] . "</td><td>" . $row["email"] . "</td><td>" . $role . "</td>
                            
                            <td>" ?><a href="adminpanel.php?del=<?php echo $row["id"] ?>"><i class="fas fa-user-minus"></i></a><?php echo "</td>";
                                        }
               
                      }
                     $con->close();

               ?>
                </table>
                </p>

                <p>
                <h1>Neuen Benutzer erstellen</h1>
                <form action="adminpanel.php" method="post" autocomplete="off">
                    <div class="row">

                        <div class="col-25">
                            <input type="text" name="username" placeholder="Benutzername" id="username" required>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-25">
                            <input type="password" name="password" placeholder="Password" id="password" required>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-25">
                            <input type="text" name="email" placeholder="E-Mail Adresse" id="email" required>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-25">
                            <select name="power" id="power" required>
                                <option value="1">Statistik</option>
                                <option value="2">Sichter</option>
                                <option value="3">RegDesk</option>
                                <option value="8">Verwaltung</option>
                                <option value="9">Administrator</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">

                        <input type="submit" value="Erstellen">

                    </div>
                </form>

                </p>


            </div>
            </div>
            <div class="content">

                <h2>Räume</h2>
            
                <table>
                    <tr>
                        <th class="th-admin">Name</th>
                        <th class="th-admin">Kapazität</th>
                        <th class="th-admin">Sanitätsbereich?</th>
                        <th class="th-admin">Löschen</th>
                    </tr>
                <?php
                
                include("./incs/db_credentials.inc.php");
                $con = new mysqli($db_host, $db_user, $db_password, $db_name);

                if (mysqli_connect_error()) {
                    die('Connect Error (' . mysqli_connect_errno() . ') '
                        . mysqli_connect_error());
                }

                $sql = "SELECT id, name, isSan, capacity FROM rooms";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        switch ($row["isSan"]) {
                            case 0:
                                $san = "Nein";
                                break;
                            case 1:
                                $san = "Ja";
                                break;
                        }
                        
                        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["capacity"] . "</td><td>" . $san . "</td>
                            
                            <td>" ?><a href="adminpanel.php?delroom=<?php echo $row["id"] ?>"><i class="fas fa-minus"></i></a><?php echo "</td>";
                              }
                          
                                       } else {
                                         echo ("Es wurden keine Räume gefunden!");
                                    }
   
             ?>
                </table>

                <h1>Neuen Raum anlegen</h1>
                <form action="adminpanel.php" method="get" autocomplete="off">
                    <div class="row">
                        <div class="col-25">
                            <label for="name">Raumname</label>
                        </div>
                        <div class="col-25">
                            <input type="text" name="name" placeholder="Name" id="name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="capacity">Kapazität</label>
                        </div>
                        <div class="col-25">
                            <input type="number" name="capacity" placeholder="Maximale Kapazität" id="capacity" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="isSan">Sanitätsbereich?</label>
                        </div>
                        <div class="col-25">
                            <input type="checkbox" name="isSan" id="isSan">
                        </div>
                    </div>

                    <div class="row">

                        <input type="submit" value="Erstellen">

                    </div>


                </form>

            </div>
            <div class="content">

                <h2>Transportmittel</h2>
            
                <table>
                    <tr>
                        <th class="th-admin">Name</th>
                        <th class="th-admin">Löschen</th>
                    </tr>
                <?php
                
                include("./incs/db_credentials.inc.php");
                $con = new mysqli($db_host, $db_user, $db_password, $db_name);

                if (mysqli_connect_error()) {
                    die('Connect Error (' . mysqli_connect_errno() . ') '
                        . mysqli_connect_error());
                }

                $sql = "SELECT id, tmittelname FROM transportmittel";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        
                        echo "<tr><td>" . $row["tmittelname"] . "</td>
                            
                            <td>" ?><a href="adminpanel.php?deltmittel=<?php echo $row["tmittelname"] ?>"><i class="fas fa-minus"></i></a><?php echo "</td>";
                              }
                    
                                       } else {
                                         echo ("Es wurden keine Transortmittel gefunden!");
                                    }
   
             ?>
                </table>
                <h1>Neues Transportmittel anlegen</h1>
                <form action="adminpanel.php" method="get" autocomplete="off">
                    <div class="row">
                        <div class="col-25">
                            <label for="tmittelname">Transportmittel</label>
                        </div>
                        <div class="col-25">
                            <input type="text" name="tmittelname" placeholder="Name" id="tmittelname" required>
                        </div>
                    </div>
                    <div class="row">

                        <input type="submit" value="Erstellen">

                    </div>


                </form>

            </div>

        </div>

</body>

</html>