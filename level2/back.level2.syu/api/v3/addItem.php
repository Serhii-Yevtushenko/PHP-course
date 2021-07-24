<?php
header("Access-Control-Allow-Credentials: true");
include 'checkSession.php';
/* Adds new entry. */
$user = $_COOKIE['userID'];
$text = $body_query['text'];
$stmt = $database->prepare("
	INSERT INTO `tododatabase`.`todolist` (`todoID`, `user`, `text`, `checked`)
	VALUES (NULL, ?, ?, FALSE)
");
if($stmt->execute([$user, $text]) === FALSE) {
    throw new Exception('Database error.');
}
/* Output. */
echo json_encode(['id' => $database->lastInsertId()]);