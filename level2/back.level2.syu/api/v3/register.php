<?php
$stmt = $database->prepare("
	INSERT INTO `tododatabase`.`users` (`userID`, `login`, `password`) 
	VALUES (NULL, ?, ?)
");
if ($stmt->execute([$body_query['login'], $body_query['pass']]) === FALSE) {
	throw new Exception('Database error.');
}	
echo json_encode(['ok' => true]);