<?php
$user = $_COOKIE['userID'];
if ($user === '') {
	throw new Exception('The session has ended. Please login again.');
}
$todoID = $body_query['id'];

$stmt = $database->prepare("
	DELETE FROM `tododatabase`.`todolist`
	WHERE `todoID` = ?
");
if($stmt->execute([$todoID]) === FALSE) {
	throw new Exception('Database error.');
}
header("Access-Control-Allow-Credentials: true");
echo(json_encode(['ok' => true]));