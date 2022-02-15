<?php
session_start();

include ("./incs/db_credentials.inc.php");

$con = new mysqli($db_host, $db_user, $db_password, $db_name); 

if ( mysqli_connect_errno() ) {

	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ( !isset($_POST['username'], $_POST['password']) ) {

	exit('Please fill both the username and password fields!');
}

if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {

	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();

	$stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();

        if (password_verify($_POST['password'], $password)) {

            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;

            require("./incs/rights.php");
                if ($usrpower == 1){
            header('Location: statistik.php');
                }else{
                    header('Location: home.php');
                }
        } else {

            echo 'Incorrect username and/or password!';
        }
    } else {

        echo 'Incorrect username and/or password!';
    }


	$stmt->close();
}
?>
