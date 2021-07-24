<?php
header("Access-Control-Allow-Credentials: true");
include 'checkSession.php';
/* Finds all entries of the specified user. */
$user = $_COOKIE['userID'];
$stmt = $database->prepare("
	SELECT `todoID`, `text`, `checked`
	FROM `tododatabase`.`todolist`
	WHERE `user` = ?
");
if ($stmt->execute([$user]) === FALSE) {
    throw new Exception('Database error.');
}
$todolist = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result = [];
foreach($todolist as $entry) {
    if ($entry['checked'] == 1) {
        $checked = true;
    } else {
        $checked = false;
    }
    $result[] = ['id' => $entry['todoID'], 'text' => $entry['text'], 'checked' => $checked];
}
/* Output. */
echo json_encode(['items' => $result]);