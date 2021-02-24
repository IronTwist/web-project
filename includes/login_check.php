<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: ../../../login.php");
}

require_once $_SERVER['DOCUMENT_ROOT']."/connection/config.php";
require_once $_SERVER['DOCUMENT_ROOT']."/includes/functions.php";
require_once $_SERVER['DOCUMENT_ROOT']."/includes/classes/User.class.php";




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST["userName"]) && !empty($_POST["password"])) {

        $user_field = $_POST["userName"];
        $password_field = $_POST["password"];

        $sql = "SELECT * FROM users WHERE userName='".$user_field."' AND password ='".md5($password_field)."'";
     
        $result = $connection->query($sql);
        
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $user = new User(
                $row["id"],
                $row["userName"], $row["password"], $row["email"], $row["first_name"], $row["last_name"], $row["sex"],
                $row["registerDate"], $row["userRole"], $row["birthday"], $row["country"], $row["city"], $row["about"]
            );

            $_SESSION["user"] = $user;
            $_SESSION["user"]->setPassword("");
            $_SESSION["logat"] = TRUE;


            $_SESSION["logo_pic"] = getUserLogoPic($row["id"]);

            if(empty($_SESSION["logo_pic"])){
                createUserProfilePic($user->getUser_id());
            }

            header("Location: ../myplace.php");
        }else{
            echo "logare esuata";
            header("Location: ../login.php?message=2");
        }

    }else{
        echo "logare esuata";
        header("Location: ../login.php?message=2");
    }

}


$connection->close();

?>
