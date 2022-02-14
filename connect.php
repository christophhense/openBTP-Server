<?php


$vorname = filter_input(INPUT_POST, 'vorname');
$nachname = filter_input(INPUT_POST, 'nachname');
$geburtsdatum = filter_input(INPUT_POST, 'geburtsdatum');
$adresse = filter_input(INPUT_POST, 'adresse');
$telefon = filter_input(INPUT_POST, 'telefon');
$erkrankungen = filter_input(INPUT_POST, 'erkrankungen');
$medis = filter_input(INPUT_POST, 'medis');
$medisgenug = filter_input(INPUT_POST, 'medisgenug');
$material = filter_input(INPUT_POST, 'material');
$TMittel = filter_input(INPUT_POST, 'TMittel');
$mobility = filter_input(INPUT_POST, 'mobility');
$bemerkungen = filter_input(INPUT_POST, 'bemerkungen');
$ort = filter_input(INPUT_POST, 'ort');


if (!empty($vorname)) {
    if (!empty($nachname)) {
        if (!empty($geburtsdatum)) {
            if (!empty($adresse)) {


                include("./incs/db_credentials.inc.php");
                $con = new mysqli($db_host, $db_user, $db_password, $db_name); 


                if ($con->connect_error) {
                    die("Connection failed: " . $con->connect_error);
                } else {
                    $sql = "INSERT INTO patienten (vorname, nachname, geburtsdatum, adresse, telefon, erkrankungen, medis, medisgenug, material, TMittel, mobility, bemerkungen, ort)
                                            values ('$vorname','$nachname','$geburtsdatum','$adresse','$telefon','$erkrankungen','$medis','$medisgenug','$material','$TMittel','$mobility','$bemerkungen','$ort')";
                                            
                    if ($con->query($sql)) {
                        

                                $last_id = $con->insert_id;
                                $sql = "INSERT INTO patlog (Event,PatID) values ('Patient neu angelegt','$last_id')";
                                $con->query($sql);
                                



                        echo "New patient is inserted sucessfully";
                    } else {
                        echo "Error: " . $sql . "
" . $con->error;
                    }
                    $con->close();
                }
            } else {
                echo "Adresse fehlt";
                die();
            }
        } else {
            echo "Geburtsdatum fehlt";
            die();
        }
    } else {
        echo "Name fehlt";
        die();
    }
} else {
    echo "Vorname fehlt";
    die();
}

?>
<meta http-equiv="refresh" content="0; url=./eingabe.php">