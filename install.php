<?php
error_reporting(E_ALL);
require_once("./incs/install.inc.php");

function install_get_current_path($filename)
{
    if (DIRECTORY_SEPARATOR === "\\") {
        return str_replace("/", "\\", getcwd() . DIRECTORY_SEPARATOR . $filename);    //to windows
    } else {
        return str_replace("\\", "/", getcwd() . DIRECTORY_SEPARATOR . $filename);    //to *nix
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Content-Script-Type" content="text/javascript">
    <link href="./style.css" rel="stylesheet">
    <link rel="stylesheet" href="./fa/css/all.css">
</head>

<body>
    <nav class="navtop">
        <div>
            <h1>BTP-Server</h1>
            <h1>Installation</h1>
        </div>
    </nav>

    <?php
    if ((isset($_GET['install_complete'])) && ($_GET['install_complete'] == "yes")) {
        try {
            $database_link = new PDO("mysql:host=localhost;dbname=" . $_POST['frm_db_dbname'], $_POST['frm_db_user'], $_POST['frm_db_password']);
            $database_link = null;
        } catch (PDOException $e) {
            $password = "<i>none entered</i>";
            if ((isset($_POST['frm_db_password'])) && ($_POST['frm_db_password'] != "")) {
                $password = $_POST['frm_db_password'];
            }
    ?>
            <div class="container">
              
                    <h1>Es konnte keine Verbindung zu der Datenbank hergestellt werden!</h1>
                    <h2>Überprüfen Sie Ihre Eingaben:</h2>
                    <table>
                        <tr>
                            <td>Fehlermeldung:</td>
                            <td><?php print $e->getMessage(); ?></td>

                        </tr>
                        <tr>
                            <td>Datenbank Name:</td>
                            <td><?php print $_POST['frm_db_dbname']; ?></td>

                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td><?php print $_POST['frm_db_user']; ?></td>

                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><?php print $password; ?></td>

                        </tr>
                        <tr>
                            <td>Host:</td>
                            <td><?php print $_POST['frm_db_host']; ?></td>

                        </tr>
                    </table>
                    <form name="db_error" method="post" action="install.php">
                        <button type="submit">Back</button>
                    </form>

            </div>
            
        <?php
            die();
        }
        $output_text = install(get_version(), $_POST['frm_option'], $_POST['frm_db_host'], $_POST['frm_db_dbname'], $_POST['frm_db_user'], $_POST['frm_db_password']);
        $first_start_str = "";
        if ($_POST['frm_option'] == "install") {
            $first_start_str = "?first_start=yes";
        }
        ?>
        <div class="container">

                        <h1>Installation wurde erfolgreich abgeschlossen!</h1>

                    
                                    <?php print $output_text; ?>
                                    <li>Startseite: 'index.html'.</li>
                                    <li>
                                       Es wird empfohlen die install.php zu entfernen oder ggf die Rechte anzupasseen um eine ungewollte neuinstallation zu verhindern!
                                    </li>
                                    <p>Benutzer: btpuser</p>
                                    <p>Passwort: bptuser</p>
                                    <h3>Nach erstem Login unmittelbar /register.php aufrufen und neuen Benutzer anlegen!</h3>
                                    <h3>Den Benutzer btpuser danach löschen!</h3>
                                  
                                
        </div>
        
                            <button onclick="location.href='index.html<?php print $first_start_str; ?>';">Next</button>
                        
        <?php
    } else {
        $filename = "./incs";
        if (!is_writable($filename)) {
            die("ERROR! Directory '" . $filename . "' is not writable. 'Write' permissions must be corrected for installation.");
            //==================================================================
            //==================================================================
        }
        $filename = './incs/db_credentials.inc.php';
        $dir = "./";
        $dh  = opendir($dir);
        while (false !== ($filename = readdir($dh))) {
            if (is_dir($filename)) {
                $files[] = $filename;
            }
        }
        $dirsOK = true;
        if (!in_array("incs", $files)) {
            $dirsOK = false;
        }
        if (!$dirsOK) {
        ?>
            
                    <div class="container">
                        At least one of the subdirectories is missing and this needs to be corrected. You might check into how the zip file was unzipped or otherwise installed.
                    
                
                    <form name="db_error" method="post" action="install.php">
                        <button type="submit">Back</button>
                    </form>
              
        <?php
        } else {
            if (file_exists("./incs/db_credentials.inc.php")) {
                include_once("./incs/db_credentials.inc.php");
                $my_host = $GLOBALS['db_host'];
                $my_user = $GLOBALS['db_user'];
                $my_passwd = $GLOBALS['db_password'];
                $my_db = $GLOBALS['db_name'];
            } else {
                $my_host = "";
                $my_user = "";
                $my_passwd = "";
                $my_db = "";
            }
            $install_checked_str = "";
            $reset_settings_checked_str = "";
            $reset_credentials_checked_str = "";
            if ((isset($_GET['write_credentials_checked'])) && ($_GET['write_credentials_checked'] == "true")) {
                $reset_credentials_checked_str = " checked";
            } else {
                if (ini_get("display_errors") == true) {

                    $reset_settings_checked_str = " checked";
                } else {
                    $install_checked_str = " checked";
                }
            }
        ?><div class="container">
                <h1>Einrichtung Datenbank</h1>
                

                <form name="install_frm" method="post" action="install.php?install_complete=yes">
                    <div class="row">
                        <div class="col-25">
                            <label for="database">Datenbank Name</label>
                        </div>
                        <div class="col-75">
                        <input type="text" size="30" maxlength="255" name="frm_db_dbname" value="<?php print $my_db;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="username">Benutzername</label>
                        </div>
                        <div class="col-75">
                        <input type="text" size="30" maxlength="255" name="frm_db_user" value="<?php print $my_user;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="password">Passwort</label>
                        </div>
                        <div class="col-75">
                        <input type="password" size="30" maxlength="255" name="frm_db_password" value="<?php print $my_passwd;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="host">Host</label>
                        </div>
                        <div class="col-75">
                        <input type="text" size="30" maxlength="255" name="frm_db_host" value="<?php print $my_host;?>">
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-25">
                            <label for="installoption">Installations Möglichkeiten</label>
                        </div>
                        <div class="col-75">
                        <label class="radio-inline"><input type="radio" value="install" name="frm_option"<?php print $install_checked_str;?>>&nbsp;Datenbank Tabellen neu installieren (löscht bereits existierende)</label><br>
											<label class="radio-inline"><input type="radio" value="reset_settings" name="frm_option"<?php print $reset_settings_checked_str;?>>&nbsp;Patient:innen Zurücksetzen (Benutzerdaten beibehalten)</label><br>
											<label class="radio-inline"><input type="radio" value="write_credentials" name="frm_option"<?php print $reset_credentials_checked_str;?>>&nbsp;Nur db-configuration schreiben</label>
                        </div>
                    </div>



                        <div class="row">
                            <p></p>
                            <button type="reset">Reset</button>
                            <button type="submit">Weiter</button>
                        </div>
                </form>

            </div>

            </div>
    <?php
        }
    }
    ?>
</body>

</html>