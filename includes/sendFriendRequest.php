<?php
require_once $_SERVER['DOCUMENT_ROOT']."/connection/config.php";
require_once $_SERVER['DOCUMENT_ROOT']."/includes/classes/User.class.php";
session_start();

if(isset($_GET["userId"])){
    $myUserId = $_SESSION["user"]->getUser_id();
    $friendId = $_GET["userId"];

    //Check if already exist
    $sql = "SELECT * FROM friend_request WHERE user_id_sender=$myUserId AND friend_id_receiver=$friendId";
    // echo $sql;
    $response = $connection->query($sql);

    if($response->num_rows == 0){
        $sql = "INSERT INTO friend_request(user_id_sender, friend_id_receiver, send_request_friend, request_approved ) VALUES ($myUserId, $friendId, TRUE, FALSE)";

        $response = $connection->query($sql);

        if($response){
            header("Location: ../home_place.php");
        }else{
            echo "Eroare";
        }
    }else{
        echo "Already sent request!";
    }
 

}
?>