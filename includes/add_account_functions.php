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

?>
