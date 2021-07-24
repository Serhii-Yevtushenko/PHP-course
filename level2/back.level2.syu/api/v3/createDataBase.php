<?php
//	executes the sql query or stops the program with an error
function doQuery($database, $request)
{
    if ($database->query($request) === FALSE) {
        exit("Request failed! $request");
    }
}

//	sets database parameters
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

// creates the requests
$requests[] = "DROP DATABASE $dbname";
$requests[] = "CREATE DATABASE $dbname";
foreach ($configDB as $table => $fields) {
    if ($table === 'parameters') {
        continue;
    }
    $arr = [];
    foreach ($fields as $field => $options) {
        $arr[] = " $field $options";
    }
    $requests[] = "CREATE TABLE `$dbname`.`$table` (" . implode(' ,', $arr) . ") ENGINE = InnoDB;";
}

// executes the requests
foreach ($requests as $request) {
    doQuery($database, $request);
}