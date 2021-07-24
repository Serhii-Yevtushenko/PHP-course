<?php
function get_id() {
	$id = file_get_contents('id.txt');
	file_put_contents('id.txt', ++$id);
	return $id;
}

$text_todo = json_decode(file_get_contents('php://input'), true)['text'];
$id_todo = get_id();
$checked_todo = false;

$database = json_decode(file_get_contents('database.json'), true);
$database[$id_todo] = array('text' => $text_todo, 'checked' => $checked_todo);
file_put_contents('database.json', json_encode($database));
echo json_encode(['id' => "$id_todo"]);