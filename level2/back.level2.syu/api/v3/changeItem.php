<?php
$user = $_COOKIE['userID'];
if ($user === '') {
	throw new Exception('The session has ended. Please login again.');
}
$text = $body_query['text'];
$checked = $body_query['checked'];
$todoID = $body_query['id'];

$stmt = $database->prepare("
	UPDATE `tododatabase`.`todolist`
	SET `text` = ?, `checked` = ?
	WHERE `todoID` = ?
");
if($stmt->execute([$text, $checked, $todoID]) === FALSE) {
	throw new Exception('Database error.');
}
header("Access-Control-Allow-Credentials: true");
echo(json_encode(['ok' => true]));