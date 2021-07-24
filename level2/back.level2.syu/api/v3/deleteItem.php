<?php
header("Access-Control-Allow-Credentials: true");
include 'checkSession.php';
/* Deletes the entry. */
$todoID = $body_query['id'];
$stmt = $database->prepare("
	DELETE FROM `tododatabase`.`todolist`
	WHERE `todoID` = ?
");
if($stmt->execute([$todoID]) === FALSE) {
    throw new Exception('Database error.');
}
/* Output. */
echo(json_encode(['ok' => true]));