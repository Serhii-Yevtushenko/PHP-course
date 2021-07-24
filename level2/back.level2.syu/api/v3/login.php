<?php
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: -1");

$stmt = $database->prepare("
	SELECT `userID`, `password`
	FROM `tododatabase`.`users`
	WHERE `login` = ?
");
if ($stmt->execute([$body_query['login']]) === FALSE) {
    throw new Exception('Database error.');
}
$arr = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$arr || ($body_query['pass'] != $arr['password'])) {
    http_response_code(400);
    throw new Exception('Incorrect login or password.');
}
$userID = $arr['userID'];

header("Set-Cookie: userID=$userID");
echo json_encode(['ok' => true]);