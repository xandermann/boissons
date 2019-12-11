<?php

try {
$config = parse_ini_file("src/Config/config.ini");
} catch(Exception $e) {
	echo "Merci de creer un fichier de configuration dans 'src/Config/config.ini'";
	die;
}

$user = $config['user'];
$pass = $config['pass'];
$db = $config['db'];
$host = $config['host'];

$query = file_get_contents("sql.sql");

$stmt = $db->prepare($query);

if ($stmt->execute())
     echo "Succes";
else
     echo "Echec";
