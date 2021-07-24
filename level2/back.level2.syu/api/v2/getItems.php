<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
// headers
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Origin: http://frontv2.level2.syu");
    //	sets database parameters
    $configDB = json_decode(file_get_contents('configDB.txt'), true);
    $hostname = $configDB['hostname'];
    $username = $configDB['username'];
    $password = $configDB['password'];

    //	creates the object of the database
    try {
        $pdo = new PDO("mysql:host=$hostname", $username, $password);
    } catch (Exception $ex) {
        exit('Something weird happened');
    }

    // defines user
    $user = $_COOKIE['userID'];

    //	PDO query
    $stmt = $pdo->prepare(
	"SELECT `todoID`, `text`, `checked` 
	FROM `tododatabase`.`todolist` 
	WHERE `todolist`.`user` = ?"
	);
    if ($stmt->execute([$user]) === FALSE) {
        die(json_encode(array('ok' => 'false')));
    }

    //	output
    $result = array();
    while ($tmp = $stmt->fetch()) {
        if ($tmp['checked'] == 0) {
            $checked = false;
        } else {
            $checked = true;
        }
        $result[] = array('id' => $tmp['todoID'], 'text' => $tmp['text'], 'checked' => $checked);
    }
    $result = ['items' => $result];

    echo json_encode($result);
}