<?php
$fresh_entry = json_decode(file_get_contents('php://input'), true);
$id_fresh_entry = $fresh_entry['id'];
$text_fresh_entry = $fresh_entry['text'];
$checked_fresh_entry = $fresh_entry['checked'];

$database = json_decode(file_get_contents('database.json'), true);

if (!array_key_exists($id_fresh_entry, $database)) {
	die(json_encode(['ok' => 'false']));
}

$database[$id_fresh_entry]['text'] = $text_fresh_entry;
$database[$id_fresh_entry]['checked'] = $checked_fresh_entry;

file_put_contents('database.json', json_encode($database));
echo json_encode(['ok' => 'true']);