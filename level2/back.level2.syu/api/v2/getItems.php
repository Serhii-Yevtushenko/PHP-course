<?php
// logger
$method = $_SERVER['REQUEST_METHOD'];
file_put_contents('log_register.txt', "\n$method, ", FILE_APPEND);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	//	sets database parameters
	$configDB = json_decode(file_get_contents('configDB.txt'), true);
	$hostname = $configDB['hostname'];
	$username = $configDB['username'];
	$password = $configDB['password'];

	//	creates the object of the database
	try {
		$pdo = new PDO("mysql:host=$hostname", $username, $password);
	} catch (Exception $ex) {
		exit('Something weird happened');
	}

	// defines user
	$user = 1; //get_headers()['Cookie'];

	//	PDO query
	$stmt = $pdo->prepare(
	"SELECT `todoID`, `text`, `checked` 
	FROM `tododatabase`.`todolist` 
	WHERE `todolist`.`user` = ?"
	);
	if ($stmt->execute([$user]) === FALSE) {
		die(json_encode(array('ok' => 'false')));
	}

	//	output
	$result = array();
	while ($tmp = $stmt->fetch()) {
		$result[] = array('id' => $tmp['todoID'], 'text' => $tmp['text'], 'checked' => $tmp['checked']);
	}
	$result = ['items' => $result];
	
	// headers
//	header("Access-Control-Allow-Headers: Content-Type");
//	header("Set-Cookie: userID=$userID");
//	header("Access-Control-Allow-Methods: POST");
//	header("Access-Control-Max-Age: 633");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Origin: http://site-syevtushenko.shpp.me");

	echo json_encode($result);
}