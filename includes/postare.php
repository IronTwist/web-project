<?php 
require_once "../connection/connection.php";
require_once "functions.php";

$message = $_GET["message"];
$user_id = $_GET["user_id"];
$titlu = $_GET["titlu"];

 //if(isset($message) && isset($user_id)){
    	insert_into_mesaje($user_id, $titlu, $message, $connection);
// }   

?>