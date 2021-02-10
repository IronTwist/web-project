<?php
require_once $_SERVER['DOCUMENT_ROOT']."/connection/config.php";
require_once $_SERVER['DOCUMENT_ROOT']."/includes/functions.php";
require_once $_SERVER['DOCUMENT_ROOT']."/includes/model/User.class.php";

session_start();

// if (isset($_GET["error"])) {
//     $error = $_GET["error"];
//     if ($error == 1) {
//         echo "<p>Eroare la logare</p>";
//     }
// }

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

            // echo "Emailul tau este: ".$_SESSION["user"]->getEmail(); 
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

if (isset($_SESSION)) {
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
}

$connection->close();

?>

<script type="text/javascript">
//     console.log(getQueryVariable('error'));
   
//     if(getQueryVariable("error") == 1){
//         alert();
//     }
// </script>