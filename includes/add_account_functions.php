<?php
require_once "../connection/connection_constants.php";
require_once "../connection/connection.php";

if(isset($_SERVER["REQUEST_METHOD"]) == "POST"){
    $userName = htmlentities($_POST["userName"]);
    $password = htmlentities($_POST["password"]);
    $lastName = htmlentities($_POST["lastName"]);
    $firstName = htmlentities($_POST["firstName"]);

    if(!empty($userName) && !empty($password) && !empty($lastName) && !empty($firstName)){
        $sql = "INSERT INTO useri(userName, password, name, prenume) VALUES ('".$userName."', '".md5($password)."', '".$lastName."', '".$firstName."')";

        if($connection->query($sql) == TRUE){
            echo "New user account succesfully created!";
            header("Location: ../add_account.php?actionResponse=1");
        }else{
            echo "Some error ocured, try again!";
            header("Location: ../add_account.php?actionResponse=0");
        }
        
    }else{
        echo "All fields are required!";
        header("Location: ../add_account.php?actionResponse=0");
    }

}

?>
