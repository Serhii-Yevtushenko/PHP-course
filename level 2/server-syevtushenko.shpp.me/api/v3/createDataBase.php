<?php
//	executes the sql query or stops the program with an error
function do_sql_query($database, $sql_query) {
	if ($database->query($sql_query) === FALSE) {
		die(" request failed! $sql_query ");
	}
}

//	sets database parameters
$configDB = parse_ini_file('database_config.ini', true);
$hostname = $configDB['access']['hostname'];
$username = $configDB['access']['username'];
$password = $configDB['access']['password'];

//	creates the object of the database
$database = new mysqli($hostname, $username, $password);
if ($database->connect_error) {
	die("database failed: ".$database->connect_error);
}

//	deletes the old database
//do_sql_query($database, "DROP DATABASE `tododatabase`");

//	creates the database
do_sql_query($database, "CREATE DATABASE tododatabase");

//	defines the query
$sql_query = array(
	"users" => 
"CREATE TABLE `tododatabase`.`users` ( 
`userID` INT NOT NULL AUTO_INCREMENT , 
`login` VARCHAR(30) NOT NULL , 
`password` VARCHAR(30) NOT NULL , 
PRIMARY KEY (`userID`), 
UNIQUE `log` (`login`)) 
ENGINE = InnoDB;"
	,
	
	"todolist" => 
"CREATE TABLE `tododatabase`.`todolist`
(
`todoID` INT NOT NULL AUTO_INCREMENT ,
`user` INT NOT NULL ,
`text` TEXT NOT NULL ,
`checked` BOOLEAN NOT NULL DEFAULT FALSE ,
PRIMARY KEY (`todoID`),
FOREIGN KEY (`user`) REFERENCES `tododatabase`.`users` (`userID`) ON DELETE CASCADE
)
ENGINE = InnoDB;"
	/*,
	"default user" => 
"INSERT INTO `tododatabase`.`users` (`userID`, `login`, `password`) 
VALUES (NULL, 'default', '1');"*/
);

// executes the requests
foreach ($sql_query as $query) {
	do_sql_query($database, $query);
}

// close connection
$database->close();