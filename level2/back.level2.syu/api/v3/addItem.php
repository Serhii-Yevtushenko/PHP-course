<?php
$user = $_COOKIE['userID'];
if ($user === '') {
	throw new Exception('The session has ended. Please login again.');
}
$text = $body_query['text'];
$stmt = $database->prepare("
	INSERT INTO `tododatabase`.`todolist` (`todoID`, `user`, `text`, `checked`)
	VALUES (NULL, ?, ?, '0')
");
if($stmt->execute([$user, $text]) === FALSE) {
	throw new Exception('Database error.');
}
header("Access-Control-Allow-Credentials: true");
echo json_encode(['id' => $database->lastInsertId()]);