<?php
// logger
$method = $_SERVER['REQUEST_METHOD'];
file_put_contents('log_register.txt', "\n$method, ", FILE_APPEND);

//============response GET method===============
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

	//	input
	$user = json_decode(file_get_contents('php://input'), true);
	$login = $user['login'];
	$password = $user['pass'];
	// PDO query
	$result = json_encode(['ok' => 'true']);
	$userID = -1;
	$stmt = $pdo->prepare(
		"SELECT `password`, `userID`
		FROM `tododatabase`.`users`
		WHERE `users`.`login` = ?"
	);
	if ($stmt->execute([$login]) === FALSE) {
		$result = json_encode(array('ok' => 'false'));
	} else {
		$pass = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if($pass[0]['password'] != $password) {
			$result = json_encode(array('ok' => 'false'));
		} else {
			$userID = $pass[0]['userID'];
		}
	}
	$stmt = null;
	file_put_contents('log_register.txt', "$userID, ", FILE_APPEND);
	
	// headers
	header("Access-Control-Allow-Headers: Content-Type");
	header("Set-Cookie: $userID");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: -1");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Origin: http://site-syevtushenko.shpp.me");
	echo $result;
}
//============end response GET method============

//============response OPTIONS method============
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	// headers
	header("Access-Control-Allow-Headers: Content-Type");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 622");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Origin: http://site-syevtushenko.shpp.me");
}
//==============end OPTIONS method===============