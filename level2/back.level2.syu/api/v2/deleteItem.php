<?php
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
//	sets database parameters
    $configDB = json_decode(file_get_contents('configDB.txt'), true);
    $hostname = $configDB['hostname'];
    $username = $configDB['username'];
    $password = $configDB['password'];

//	input
    $sought_entry = json_decode(file_get_contents('php://input'), true);
    $id_sought_entry = $sought_entry['id'];

//	creates the object of the database
    try {
        $pdo = new PDO("mysql:host=$hostname", $username, $password);
    } catch(Exception $ex) {
        exit('Something weird happened');
    }

//	defines user
    $user = $_COOKIE['userID'];

//	prepared query
    $stmt = $pdo->prepare(
	"DELETE FROM `tododatabase`.`todolist` 
	WHERE `todolist`.`todoId` = ? AND `todolist`.`user` = ?"
	);
    if ($stmt->execute([$id_sought_entry, $user]) === FALSE) {
        die(json_encode(array('ok' => 'false')));
    }

//	headers
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Origin: http://frontv2.level2.syu");
//	output
    echo json_encode(['ok' => true]);
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header("Access-Control-Allow-Headers: Content-Type");
	header("Access-Control-Allow-Methods: DELETE");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Max-Age: -1");
	header("Access-Control-Allow-Origin: http://frontv2.level2.syu");
}