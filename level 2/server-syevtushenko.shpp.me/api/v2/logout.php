<?php
// logger
$method = $_SERVER['REQUEST_METHOD'];
file_put_contents('log_register.txt', "\n$method, ", FILE_APPEND);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	header("Access-Control-Allow-Origin: http://site-syevtushenko.shpp.me");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Headers: content-type");
//	output
	echo json_encode(array('ok' => true));
}