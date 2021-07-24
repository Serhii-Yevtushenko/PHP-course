<?php
header("Access-Control-Allow-Credentials: true");
header("Set-Cookie: userID=");
echo json_encode(['ok' => true]);