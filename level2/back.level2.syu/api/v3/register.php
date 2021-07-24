<?php
/* Checks if an entry with this login exists. */
$stmt = $database->prepare("
    SELECT `userID`
    FROM `tododatabase`.`users`
    WHERE `login` = ?
");
if ($stmt->execute([$body_query['login']]) === FALSE) {
    throw new Exception('Database error.');
}
$userID = $stmt->fetchAll();
if (count($userID) > 0) {
    http_response_code(400);
    throw new Exception('A user with this login already exists. Please enter a different username.');
}
/* Inserts a new entry in the database. */
$stmt = $database->prepare("
	INSERT INTO `tododatabase`.`users` (`userID`, `login`, `password`) 
	VALUES (NULL, ?, ?)
");
if ($stmt->execute([$body_query['login'], $body_query['pass']]) === FALSE) {
    throw new Exception('Database error.');
}

/* Output. */
echo json_encode(['ok' => true]);