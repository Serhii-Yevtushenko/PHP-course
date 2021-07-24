<?php
$sought_entry = json_decode(file_get_contents('php://input'), true);
$id_sought_entry = $sought_entry['id'];

$database = json_decode(file_get_contents('database.json'), true);

if (!array_key_exists($id_sought_entry, $database)) {
	die(json_encode(['ok' => 'false']));
}

unset($database[$id_sought_entry]);
file_put_contents('database.json', json_encode($database));
echo json_encode(['ok' => 'true']);