<?php
require_once "../connection/connection_constants.php";
require_once "../connection/connection.php";

function check_input($data)
  {
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

function modificaString($text){
    $text = strtolower($text);
    $textFields = explode(" ", $text);
    $textReturn= "";

    foreach($textFields as $string){
        for($j=0; $j < strlen($string); $j++){
            if($j == 0){
                $textReturn .= " ".strtoupper($string[$j]);
                $nr = 0;
            }else{
                $textReturn .= $string[$j];
            }
        }
    }
    return trim($textReturn);
}

if(isset($_SERVER["REQUEST_METHOD"]) == "POST"){

    if (empty($_POST["prenume"])){
        $prenumeerr="*Prenumele este obligatoriu"."<br>";
        $eroare=1;
    }else{
        $prenume = test_input($_POST["prenume"]);
        $prenume = modificaString($prenume);

        if (!preg_match("/^[a-zA-Z ]*$/",$prenume))
        {
            $prenumeerr="*Numai litere si spatii sunt acceptate la prenume!"."<br>";
            $eroare=1;
        }
    }

    // $userName = htmlentities($_POST["userName"]);
    // $password = htmlentities($_POST["password"]);
    // $lastName = htmlentities($_POST["lastName"]);
    // $firstName = htmlentities($_POST["firstName"]);

    // if(!empty($userName) && !empty($password) && !empty($lastName) && !empty($firstName)){
    //     $sql = "INSERT INTO useri(userName, password, name, prenume) VALUES ('".$userName."', '".md5($password)."', '".$lastName."', '".$firstName."')";

    //     if($connection->query($sql) == TRUE){
    //         echo "New user account succesfully created!";
    //         header("Location: ../add_account.php?actionResponse=1");
    //     }else{
    //         echo "Some error ocured, try again!";
    //         header("Location: ../add_account.php?actionResponse=0");
    //     }
        
    // }else{
    //     echo "All fields are required!";
    //     header("Location: ../add_account.php?actionResponse=0");
    // }

}

?>
