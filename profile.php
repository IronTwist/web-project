<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."../includes/header.php";

if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];

    if (isset($_GET["userId"])) {
        //View user profile

        $userId = $_GET["userId"];

        showProfile($userId, "friend");
    } else {
        if(isset($_GET["editUser"])){
            editProfile($user->getUser_id());
            
        }else{
            //View my profile profile
            showProfile($user->getUser_id(), "user");
        }
        
    }
}else{
    header("Location: login.php");
}
require_once $root."/includes/footer.php";
?>