<?php
header("Access-Control-Allow-Origin: http://site-syevtushenko.shpp.me");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header("Access-Control-Allow-Methods: PUT, DELETE");
	header("Access-Control-Allow-Headers: content-type");
	header("Access-Control-Allow-Credentials: true");
} else {
	$body_query = json_decode(file_get_contents('php://input'), true);
	try {
		include 'open_database.php';
		switch ($_GET["action"]) {
			case 'register':
				include 'register.php';
				break;
			case 'login':
				include 'login.php';
				break;
			case 'getItems':
				include 'getItems.php';
				break;
			case 'logout':
				include 'logout.php';
				break;
			case 'addItem':
				include 'addItem.php';
				break;
			case 'changeItem':
				include 'changeItem.php';
				break;
			case 'deleteItem':
				include 'deleteItem.php';
				break;
		}
	} catch (Exception $e) {
		if (str_contains($e->getMessage(), 'Duplicate')) {
			http_response_code(409);	// If a user with this login already exists.
		} else {
			http_response_code(500);	// If other exception.
		}
		echo $e->getMessage();
	}
}