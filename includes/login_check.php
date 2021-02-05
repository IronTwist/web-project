<?php
require_once "../connection/connection_constants.php";
require_once "../connection/connection.php";
require_once "functions.php";
session_start();

$user_field = $_POST["userName"];
$password_field = $_POST["password"];

$error = $_GET["error"];
if($error == 1){
        echo "<p>Eroare la logare</p>";
}

$result = result_select_query("SELECT * FROM useri WHERE userName='".$user_field."' AND password ='".md5($password_field)."'", $connection);

if ($result->num_rows > 0){
	
	while($row = $result->fetch_assoc()){

                $_SESSION["user"] = $user_field;
                $_SESSION["password"] = md5($password_field);
                $_SESSION["logat"] = TRUE;
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["name"] = $row["name"];
                $_SESSION["surname"] = $row["prenume"];

                echo "sesiune setata";
                header("Location: ../action_page.php");
	}
	
}else{
	echo "Logare eronata, incearca iar!";
	header("Location: ../login.php?error=1");
}

?>
<!-- 
<script type="text/javascript">
    console.log(getQueryVariable('error'));
   
    if(getQueryVariable("error") == 1){
        alert();
    }
</script> -->