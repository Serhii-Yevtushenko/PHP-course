<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//	sets database parameters
	$configDB = json_decode(file_get_contents('configDB.txt'), true);
	$hostname = $configDB['hostname'];
	$username = $configDB['username'];
	$password = $configDB['password'];

//	input
	$text_todo = json_decode(file_get_contents('php://input'), true)['text'];

//	creates the object of the database
	$dsn = "mysql:host=$hostname";
	try {
		$pdo = new PDO($dsn, "$username", "$password");
	} catch (Exception $e) {
		exit('Something weird happened');
	}

// defines user
	$user = 1;

// PDO query
	$stmt = $pdo->prepare(
		"INSERT INTO `tododatabase`.`todolist` (`todoId`, `user`, `text`, `checked`) 
		VALUES (NULL, ?, ?, '0')"
	);
	if ($stmt->execute([$user, $text_todo]) === FALSE) {
		die(json_encode(array('ok' => false)));
	}
	$stmt = null;
	
//	headers
	header("Access-Control-Allow-Origin: http://site-syevtushenko.shpp.me");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Headers: content-type");
	header("Access-Control-Allow-Methods: POST");
//	output
	echo json_encode(array('id' => $pdo->lastInsertId()));
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header("Access-Control-Allow-Headers: Content-Type");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Max-Age: 622");
	header("Access-Control-Allow-Origin: http://site-syevtushenko.shpp.me");
}