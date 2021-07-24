<?php
header("Access-Control-Allow-Credentials: true");
$user = $_COOKIE['userID'];
if ($user === '') {
    throw new Exception('The session has ended. Please login again.');
}
$text = $body_query['text'];
$checked = $body_query['checked'];
$todoID = $body_query['id'];

if ($text === "") {
    http_response_code(400);
    throw new Exception('Task cannot be empty string');
}

$stmt = $database->prepare("
	UPDATE `tododatabase`.`todolist`
	SET `text` = ?, `checked` = ?
	WHERE `todoID` = ?
");
if($stmt->execute([$text, $checked, $todoID]) === FALSE) {
    throw new Exception('Database error.');
}
echo(json_encode(['ok' => true]));