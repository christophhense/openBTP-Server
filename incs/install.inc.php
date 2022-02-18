<?php

function get_version() {
	return "v1.0.0";
}
function open_database($host, $database, $user, $password) {
	try {
		$GLOBALS['DATABASE_LINK'] = null;
		$GLOBALS['DATABASE_LINK'] = new PDO("mysql:host=" . $host . ";dbname=" . $database , $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
		$GLOBALS['DATABASE_LINK']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
		$GLOBALS['DATABASE_LINK']->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br>";
		@error_log("Error!: " . $e->getMessage());
		die ();
	}
}

function close_database() {
	$GLOBALS['DATABASE_LINK'] = null;
}

function write_conf($host, $db, $user, $password) {
	if (!$fp = fopen('./incs/db_credentials.inc.php', 'a')) {
		return "<li>db_credentials.inc.php kann nicht geöffnet werden! Rechte überprüfen!</li>";
	} else {
		ftruncate($fp, 0);
		fwrite($fp, "<?php\n");
		fwrite($fp, '	$GLOBALS[\'db_host\'] 		= ' . "'" . $host . "';\n");
		fwrite($fp, '	$GLOBALS[\'db_name\'] 		= ' . "'" . $db . "';\n");
		fwrite($fp, '	$GLOBALS[\'db_user\'] 		= ' . "'" . $user . "';\n");
		fwrite($fp, '	$GLOBALS[\'db_password\'] 	= ' . "'" . $password . "';\n");
		fwrite($fp, '?>');
	}
	fclose($fp);
	return "<li>Konfiguration unter: /incs/db_credentials.inc.php gespeichert!</li>";
}

function do_sql_file($filename) {
	$import = file_get_contents($filename);
	$stmt = $GLOBALS['DATABASE_LINK']->prepare($import);
	$stmt->execute();
	$i = 0;
	do {
		$i++;
	} while ($stmt->nextRowset());
	$error_message = $stmt->errorInfo();
	if ($error_message[0] != "00000") {
		$line = __LINE__ - 7;
		$error_message = $GLOBALS['DATABASE_LINK']->errorInfo();
		@error_log($filename . ": query " . $i . "failed: " . $error_message[2] . " in " . basename(__FILE__) . " line " . $line . "\r\n" . $import);
		print "<span style='color:red'>" . $filename . ": query $i failed: " . $error_message[2] . " in " . basename(__FILE__) . " line " . $line . "</span><br>";
		die ();
	}
	
}



function install($version, $option, $host, $name, $user, $password) {

	open_database($host, $name, $user, $password);
	$output_text = "";
	switch ($option) {
	case "install":	
		do_sql_file("./sql/drop_database_accounts.sql");
		do_sql_file("./sql/drop_database_patlog.sql");
		do_sql_file("./sql/drop_database_patienten.sql");
		do_sql_file("./sql/drop_database_patlog.sql");
		do_sql_file("./sql/drop_database_rooms.sql");
		do_sql_file("./sql/drop_database_transportmittel.sql");
		do_sql_file("./sql/accounts.sql");
		do_sql_file("./sql/patienten.sql");	
		do_sql_file("./sql/patlog.sql");
		do_sql_file("./sql/rooms.sql");
		do_sql_file("./sql/transportmittel.sql");
		$output_text .= "<li> Datenbankinstallation abgeschlossen!";
		$output_text .= write_conf($host, $name, $user, $password);
		break;
	case "reset_settings":
		do_sql_file("./sql/drop_database_patlog.sql");
		do_sql_file("./sql/drop_database_patienten.sql");
		do_sql_file("./sql/patienten.sql");
		do_sql_file("./sql/patlog.sql");
		$output_text .= "<li> Patientendaten erfolgreich zurückgesetzt!</li>";
		$output_text .= write_conf($host, $name, $user, $password);
		break;
	case "write_credentials":
		$output_text .= write_conf($host, $name, $user, $password);
		break;
	default:
		$output_text .= "<li> '" . $option . "' ist keine valide Option!</font></li>";
		@error_log($output_text . "\r\n");
	}
	return $output_text;
}


?>