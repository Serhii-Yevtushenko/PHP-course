<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	header("Access-Control-Allow-Origin: http://frontv2.level2.syu");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Headers: content-type");
    header("Set-Cookie: userID=");
//	output
	echo json_encode(array('ok' => true));
}