<?php
require_once "connection_constants.php";

$servername = DB_SERVER;
$username = DB_USER;
$password = DB_PASS;
$db_name = DB_NAME;

function connection_to_db($servername, $username, $password, $db_name){
    $conexiune = new mysqli($servername, $username, $password, $db_name);
    if ($conexiune->connect_error) {
        die("Connection failed: " . $conexiune->connect_error);
    }

// echo "Conectare cu succes la baza de date </br></br>";

    return $conexiune;
}

$connection = connection_to_db($servername, $username, $password, $db_name);

?>
