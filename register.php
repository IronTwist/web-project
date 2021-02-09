<?php
require $_SERVER['DOCUMENT_ROOT']."/includes/header.php";


function check_input($data)
  {
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

function changeStringToUpper($text){
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

if (isset($_SERVER["REQUEST_METHOD"]) == "POST") {

    if (empty($_POST["username"])){
        $usereer="*User required"."<br>";
        $eroare=1;
    }else{
        $user = check_input($_POST["username"]);

        if (!preg_match("/^[a-zA-Z1-9]*$/",$user))
        {
            $usereer="*Only letters and numbers are allowed!"."<br>";
            $eroare=1;
        }
    }

    if (empty($_POST["fname"])){
        $fnameerr="*First name required"."<br>";
        $eroare=1;
    }else{
        $fname = check_input($_POST["fname"]);
        $fname = changeStringToUpper($fname);
      

        if (!preg_match("/^[a-zA-Z ]*$/",$fname))
        {
            $fnameerr="*Only letters and space"."<br>";
            $eroare=1;
        }
    }

    if (empty($_POST["lname"])) {
        $lnameerr="*Last name required"."<br>";
        $eroare=1;
    } else {
        $lname = check_input($_POST["lname"]);
        $lname = changeStringToUpper($lname);

        if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
            $lnameerr="*Only letters and space"."<br>";
            $eroare=1;
        }
    }

    if (empty($_POST["password"]) || empty($_POST["password2"])){
        $passworderr="*Password required!"."<br>";
        $eroare=1;
    }else{
        $password = check_input($_POST["password"]);
        $password2 = check_input($_POST["password2"]);

        if($password == $password2){
            if (!preg_match("/^[a-zA-Z1-9]*$/",$password)){
                $passworderr="*Numai litere si numere sunt acceptate la password!"."<br>";
                $eroare=1;
            }

            $password = md5($password);
        }else{
            $passworderr="Passwords don't match"."<br>";
            $eroare=1;
        }
    }

    if (empty($_POST["email"])){
        $emailerr="*Email-ul este obligatoriu"."<br>";
        $eroare=1;
    }else{
        $email = check_input($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $emailerr="*Invalid email format"."<br>";
            $eroare=1;
        }
    }

    if (empty($_POST["sex"])){
        $sexerr="*No sex selected!"."<br>";
        $eroare=1;
    }else{
        $sex = check_input($_POST["sex"]);
    }

    if ($eroare == 0) {
        $drepturi = "simplu";

        $stmt = $connection->prepare("INSERT INTO utilizatori (username, parola, sex, starecivila, nume, prenume, email, dataregistrare, extensie, drepturi) 
        VALUES (?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param("ssiissssss", $user, $password, $sex, $stareCivila, $nume, $prenume, $email, $currentDate, $extension, $drepturi);
    
        
    }

}//end $_SERVER["REQUEST_METHOD"] check

?>

<div class="registerForm">
     
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data" >
    <div class="centralForm">
        <legend>Become a member in MyPlace comunity</legend></br>
        <div class="aroundField">
            <label class="registerLabel" for="username">Username:</label><br>
            <input class="inputField" type="text" id="username" name="username" required><br>
        </div>
        <div class="aroundField">
            <label class="registerLabel" for="password">Password:</label><br>
            <input class="inputField" type="password" id="password" name="password" required><br>
            <div class="hintPassword">Required at least one Uppercase letter, number and a special char(!,@,%,&,$)</div>
            

            <label class="registerLabel" for="password2">Repeat password:</label><br>
            <input class="inputField" type="password" id="password2" name="password2" required><br>
        </div>
        <div class="aroundField">
        <label class="registerLabel" for="email">Email:</label><br>
        <input class="inputField" type="email" id="email" name="email" placeholder="example@yahoo.com" onchange="checkEmail(this)" required><br>
        <!-- <span id="email-notice" class="notice"></span></br> -->

        <label class="registerLabel" for="fname">First name:</label><br>
        <input class="inputField" type="text" id="fname" name="fname" placeholder="e.g. Connor"><br>
    
        <label class="registerLabel" for="lname">Last name:</label><br>
        <input class="inputField" type="text" id="lname" name="lname" placeholder="e.g. John"><br>

        <label class="registerLabel" for="sex">Sex:</label><br>
            <input type="radio" id="male" name="sex" value="1" checked>
            <label for="male">male</label>
            <input type="radio" id="female" name="sex" value="2">
            <label for="female">female</label></br>

        <label class="registerLabel" for="birthday">Birthday:</label><br>
        <input type="date" id="birthday" name="birthday"><br></br>
        </div>

        <div class="aroundField">
            <label class="registerLabel" for="country">Country:</label><br>
            <input type="text" id="country" name="country" placeholder="Type country"><br>

            <label class="registerLabel" for="city">City:</label><br>
            <input type="text" id="city" name="city" placeholder="Type city"><br>

            <label class="registerLabel" for="username">About:</label><br>
            <textarea class="about" name="about" placeholder="Add extra info, e.g. hobbies"></textarea>
        </div>
        </br>
        <button id="reset" type="reset">Reset</button></br></br>
        <input id="submit" type="submit" name="submit" value="Submit"></br>
    </div>
</form></br>
<span class="error"> <?php
    echo $numeerr;
    echo $prenumeerr;
    echo $usereer;
    echo $passworderr;
    echo $sexerr;
    echo $stareCivilaerr;
    echo $emailerr;
    echo $fileerr;

?></span>
<script>
    

    $('#password').keyup(function(){
		
        function verific(parola){
            
            if(parola.match(/\d/g) && parola.match(/[A-Z]/g) && parola.match(/[a-z]/g) && parola.match(/[!]/g)){
                document.getElementById("password").style.backgroundColor = "#52BE80";
                
            }else {
                document.getElementById("password").style.backgroundColor = "red";

            }
        }
        
        $("#indicator").html(verific($("#password").val()));
            
    });

    $('#password2').keyup(function(){
		
        function verific(parola){
            console.log(parola); 
            if(parola.match(/\d/g) && parola.match(/[A-Z]/g) && parola.match(/[a-z]/g) && parola.match(/[!]/g)){
                document.getElementById("password2").style.backgroundColor = "#52BE80";
            }else {
                document.getElementById("password2").style.backgroundColor = "red";
            }
        }
        
        $("#indicator").html(verific($("#password2").val()));
            
    });

</script>
</div>


<?php
require $_SERVER['DOCUMENT_ROOT']."/includes/footer.php";
?>