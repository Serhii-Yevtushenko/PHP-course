<?php
$configDB = parse_ini_file('database_config.ini', true, INI_SCANNER_RAW);
$hostname = $configDB['parameters']['hostname'];
$username = $configDB['parameters']['username'];
$password = $configDB['parameters']['password'];
$driver = $configDB['parameters']['driver'];
$dbname = $configDB['parameters']['dbname'];
$charset = $configDB['parameters']['charset'];

//	creates the object of the database
$dsn = $driver . ':host=' . $hostname . ';dbname=' . $dbname . ';charset=' . $charset;
try {
    $database = new PDO($dsn, $username, $password);
} catch (Exception $e) {
    exit("Cannot create the PDO object: dsn=$dsn, username=$username, password=$password");
}