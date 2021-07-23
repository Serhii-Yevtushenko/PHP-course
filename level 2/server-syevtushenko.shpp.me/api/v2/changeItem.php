<?php

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
//	sets database parameters
	$configDB = json_decode(file_get_contents('configDB.txt'), true);
	$hostname = $configDB['hostname'];
	$username = $configDB['username'];
	$password = $configDB['password'];

//	input
	$fresh_entry = json_decode(file_get_contents('php://input'), true);
	$id_fresh_entry = $fresh_entry['id'];
	$text_fresh_entry = $fresh_entry['text'];
	$checked_fresh_entry = $fresh_entry['checked'];
	
//	file_put_contents('log_register.txt', "id_fresh_entry=$id_fresh_entry, text_fresh_entry=$text_fresh_entry, checked_fresh_entry=$checked_fresh_entry", FILE_APPEND);

//	creates the object of the database
	try {
		$pdo = new PDO("mysql:host=$hostname", $username, $password);
	} catch(Exception $ex) {
		exit('Something weird happened');
	}

// defines user
	$user = 1;
//	PDO query
	$stmt = $pdo->prepare(
	"UPDATE `tododatabase`.`todolist` 
	SET `text` = ?, `checked` = ? 
	WHERE `todolist`.`todoId` = ? AND `todolist`.`user` = ?"
	);
	if ($stmt->execute([$text_fresh_entry, $checked_fresh_entry, $id_fresh_entry, $user]) === FALSE) {
		die(json_encode(array('ok' => false)));
	}
	$stmt = null;
	
//	headers
	header("Access-Control-Allow-Origin: http://site-syevtushenko.shpp.me");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Headers: content-type");
	header("Access-Control-Allow-Methods: PUT");
//	output
	echo json_encode(array('ok' => true));
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header("Access-Control-Allow-Headers: Content-Type");
	header("Access-Control-Allow-Methods: PUT");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Max-Age: 622");
	header("Access-Control-Allow-Origin: http://site-syevtushenko.shpp.me");
}