<?php
$database_config = parse_ini_file('database_config.ini', true);
$database = new PDO(
	"mysql:host=".$database_config['access']['hostname'], 
	$database_config['access']['username'], 
	$database_config['access']['password']
);