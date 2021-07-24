<?php
/* Checks if the session has ended. */
if ($_COOKIE['userID'] === '') {
    http_response_code(400);
    throw new Exception('The session has ended. Please login again.');
}