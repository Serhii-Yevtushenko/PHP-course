<?php
header("Access-Control-Allow-Credentials: true");

$stmt = $database->prepare("
	SELECT `todoID`, `text`, `checked`
	FROM `tododatabase`.`todolist`
	WHERE `user` = ?
");
$user = $_COOKIE['userID'];
if ($user === '') {
    http_response_code(400);
    throw new Exception('The session has ended. Please login again.');
}
if ($stmt->execute([$user]) === FALSE) {
    throw new Exception('Database error.');
}
$todolist = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result = [];
foreach($todolist as $entry) {
    $result[] = ['id' => $entry['todoID'], 'text' => $entry['text'], 'checked' => $entry['checked']];
}
echo json_encode(['items' => $result]);