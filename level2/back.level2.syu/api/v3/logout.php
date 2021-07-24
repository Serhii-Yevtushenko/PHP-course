<?php
header("Access-Control-Allow-Credentials: true");
header("Set-Cookie: userID=");
/* Output. */
echo json_encode(['ok' => true]);