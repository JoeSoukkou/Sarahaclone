<?php

include_once 'psl-config.php';   // Needed because functions.php is not included

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
if ($mysqli->connect_error) {
    echo "Error Trying to connect to mysql ! Please check Your Configuration (Passwords , Working Ports , Username ...)";
    exit();
}
