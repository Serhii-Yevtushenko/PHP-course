<?php
// =======response POST=======
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
$stmt = $pdo->prepare(
	"INSERT INTO `tododatabase`.`users` (`userID`, `login`, `password`) 
	VALUES (NULL, ?, ?)"
);
try {
if ($stmt->execute([$login, $password]) === FALSE) {
	$result = json_encode(array('ok' => 'false'));
}
} catch (Exception $ex) {
	$result = json_encode(array('ok' => 'false'));
}
$stmt = null;

header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Origin: http://site-syevtushenko.shpp.me");
header("Content-Type: application/json");
echo $result;
} else
// =======end response POST=======


// =======response OPTIONS=======
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header("Access-Control-Allow-Headers: Content-Type");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 622");
	header("Access-Control-Allow-Origin: http://site-syevtushenko.shpp.me");
}
// =======END response OPTIONS=======