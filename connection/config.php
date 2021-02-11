<?php
require_once "connection_constants.php";

$servername = DB_SERVER;
$username = DB_USER;
$password = DB_PASS;
$db_name = DB_NAME;

$connection = new mysqli($servername, $username, $password, $db_name);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
 
?>
