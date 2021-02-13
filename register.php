<?php
require $_SERVER['DOCUMENT_ROOT']."/includes/header.php";

$user=$password=$fname=$lname=$email=$sex=$birthday=$country=$city=$about= "";
$usereer=$passworderr=$fnameerr=$lnameerr=$emailerr=$sexerr=$birthdayerr=$countryerr=$cityerr=$abouterr = "";

//Check inserted data to be correct
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

if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST"){

    $eroare = 0;

    if(isset($_POST["username"])){
        if(empty($_POST["username"])){
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
    }
    
    if (isset($_POST["fname"])) {
        if (empty($_POST["fname"])){
            $fnameerr="*First name required"."<br>";
            $eroare=1;
        }else{
            $fname = check_input($_POST["fname"]);
            $fname = changeStringToUpper($fname);
        
            if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
                $fnameerr="*Only letters and space"."<br>";
                $eroare=1;
            }
        }
    }

    if (isset($_POST["lname"])) {
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
    }

    if (isset($_POST["password"]) && isset($_POST["password2"])) {
        if (empty($_POST["password"]) || empty($_POST["password2"])){
            $passworderr="*Password required!"."<br>";
            $eroare=1;
        }else{
            $password = check_input($_POST["password"]);
            $password2 = check_input($_POST["password2"]);

            if($password == $password2){
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number    = preg_match('@[0-9]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);

                echo $number;

                if(strlen($password) < 8 || !$uppercase || !$lowercase || !$number || !$specialChars) {
                    $passworderr="*Numai litere si numere sunt acceptate la password!"."<br>";
                    $eroare=1;
                }

                $password = md5($password);
            }else{
                $passworderr="Passwords don't match"."<br>";
                $eroare=1;
            }
        }
    }

    if (isset($_POST["email"])) {
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
    }

    if (isset($_POST["sex"])) {
        if (empty($_POST["sex"])){
            $sexerr="*No sex selected!"."<br>";
            $eroare=1;
        }else{
            $sex = check_input($_POST["sex"]);
        }
    }

    if (isset($_POST["birthday"])) {
        if (empty($_POST["birthday"])){
            $birthday = null;
            
        }else{
            $birthday = check_input($_POST["birthday"]);
        }
    }

    if (isset($_POST["country"])) {
        if (empty($_POST["country"])) {
            $country = "";
           
        } else {
            $country = check_input($_POST["country"]);
            $country = changeStringToUpper($country);

            if (!preg_match("/^[a-zA-Z ]*$/", $country)) {
                $countryerr="*Only letters and space"."<br>";
                $eroare=1;
            }
        }
    }

    if (isset($_POST["city"])) {
        if (empty($_POST["city"])) {
            $city = "";
           
        } else {
            $city = check_input($_POST["city"]);
            $city = changeStringToUpper($city);

            if (!preg_match("/^[a-zA-Z ]*$/", $city)) {
                $cityerr="*Only letters and space"."<br>";
                $eroare=1;
            }
        }
    }

    if (isset($_POST["about"])) {
        if (empty($_POST["about"])) {
            
            $about = "";
            
        } else {
            $about = check_input($_POST["about"]);
            $about = changeStringToUpper($about);

            if (!preg_match("/^[a-zA-Z1-9@#$%^&* ]*$/", $about)) {
                $abouterr="*Not all characters are allowed"."<br>";
                $eroare=1;
            }
        }
    }

    //After checking data 
    if ($eroare == 0) {
  
        $stmt = $connection->prepare("INSERT INTO users (userName, password, email, first_name, last_name, sex, birthday, country, city, about) 
        VALUES (?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param("sssssissss", $user, $password, $email, $fname, $lname, $sex, $birthday, $country, $city, $about);
        
        if ($stmt->execute() === true) {
            $stmt->close();
            header("Location: login.php?message=1");
        }else{
            echo "*User already exist!"."<br>";
        }
    }

}else{
    ?>

<div class="registerForm">
     
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data" >
    <div class="centralForm">
        <legend>Become a member in MyPlace community</legend></br>
        <div class="aroundField">
            <label class="registerLabel" for="username">Username:</label><br>
            <input class="inputField" type="text" id="username" name="username" value="<?php echo $user; ?>" ><br>
        </div>
        <div class="aroundField" onclick="showRequiredPasswordStyle(this)">
            <label class="registerLabel" for="password">Password:</label><br>
            <input class="inputField" type="password"  id="password" name="password" required><br>
           
            <label class="registerLabel" for="password2">Repeat password:</label><br>
            <input class="inputField" type="password" id="password2" name="password2" required><br>
            <div class="hintPassword" id="hintPassword">Make sure you use uppercase letter, number, at least 8 chars and a special char from list(!,@,%,&,$,#)</div>
            
        </div>
        <div class="aroundField">
        <label class="registerLabel" for="email">Email:</label><br>
        <input class="inputField" type="email" id="email" name="email" placeholder="example@yahoo.com" onchange="checkEmail(this)" value="<?php echo $email; ?>" required><br>
        <!-- <span id="email-notice" class="notice"></span></br> -->

        <label class="registerLabel" for="fname">First name:</label><br>
        <input class="inputField" type="text" id="fname" name="fname" value="<?php echo $fname; ?>" placeholder="e.g. Connor"><br>
    
        <label class="registerLabel" for="lname">Last name:</label><br>
        <input class="inputField" type="text" id="lname" name="lname" value="<?php echo $lname; ?>" placeholder="e.g. John"><br>

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
            <input type="text" id="country" name="country" value="<?php echo $country; ?>" placeholder="Type country"><br>

            <label class="registerLabel" for="city">City:</label><br>
            <input type="text" id="city" name="city" value="<?php echo $city; ?>" placeholder="Type city"><br>

            <label class="registerLabel" for="username">About:</label><br>
            <textarea class="about" name="about" value="<?php echo $about; ?>" placeholder="Add extra info, e.g. hobbies"></textarea>
        </div>
        </br>
        <button id="reset" type="reset">Reset</button></br></br>
        <input id="submit" type="submit" name="submit" value="Submit">
    </div>
</form>
<span class="error"> <?php
    echo $usereer;
    echo $passworderr;
    echo $fnameerr;
    echo $lnameerr;
    echo $emailerr;
    echo $sexerr;
    echo $birthdayerr;
    echo $countryerr;
    echo $cityerr;
    echo $abouterr; ?></span>
<?php
}?>
<script>

function checkEmail(emailInput){
    let emailExist = 0;

	var email=emailInput.value;
	var request=new XMLHttpRequest();
	request.onreadystatechange=function() {
		if (request.readyState == 4)
			if (request.status == 200){
				if(request.responseText=="1"){
					document.getElementById("email").style.backgroundColor="#52BE80";
                }    
				if(request.responseText=="0"){
					document.getElementById("email").style.backgroundColor="red";
                }
                emailExist=parseInt(request.responseText);
			}
			else 
                emailExist=parseInt(0);
	}
	request.open("GET","/includes/checkEmail.php?email="+email,true);
	request.send("");
}

</script>
<script>
function showRequiredPasswordStyle(element){
   document.getElementById("hintPassword").style.display = "block"; 
}

$('#password').keyup(function(){
    
    function verific(parola){
        
        if(parola.length == 0){
            document.getElementById("password").style.backgroundColor = "white";
        }else{
        
            if(parola.match(/\d/g) && parola.match(/[A-Z]/g) && parola.match(/[a-z]/g) && parola.match(/[!]/g)){
                document.getElementById("password").style.backgroundColor = "#52BE80"; 
            }else if(parola.match(/\d/g) && parola.match(/[A-Z]/g) && parola.match(/[a-z]/g) && parola.match(/[@]/g) && parola.length >= 8){
                document.getElementById("password").style.backgroundColor = "#52BE80"; 
            }else if(parola.match(/\d/g) && parola.match(/[A-Z]/g) && parola.match(/[a-z]/g) && parola.match(/[%]/g) && parola.length >= 8){
                document.getElementById("password").style.backgroundColor = "#52BE80"; 
            }else if(parola.match(/\d/g) && parola.match(/[A-Z]/g) && parola.match(/[a-z]/g) && parola.match(/[#]/g) && parola.length >= 8){
                document.getElementById("password").style.backgroundColor = "#52BE80"; 
            }else if(parola.match(/\d/g) && parola.match(/[A-Z]/g) && parola.match(/[a-z]/g) && parola.match(/[&]/g) && parola.length >= 8){
                document.getElementById("password").style.backgroundColor = "#52BE80"; 
            }else if(parola.match(/\d/g) && parola.match(/[A-Z]/g) && parola.match(/[a-z]/g) && parola.match(/[$]/g) && parola.length >= 8){
                document.getElementById("password").style.backgroundColor = "#52BE80"; 
            }else{
                document.getElementById("password").style.backgroundColor = "red";
            } 
        }    
    }
    
    $("#indicator").html(verific($("#password").val()));
        
});

$('#password2').keyup(function(){
    
    function verific(parola){

        if(parola.length == 0){
            document.getElementById("password2").style.backgroundColor = "white";
        }else{
        
            if(parola.match(/\d/g) && parola.match(/[A-Z]/g) && parola.match(/[a-z]/g) && parola.match(/[!]/g)){
                document.getElementById("password2").style.backgroundColor = "#52BE80"; 
            }else if(parola.match(/\d/g) && parola.match(/[A-Z]/g) && parola.match(/[a-z]/g) && parola.match(/[@]/g) && parola.length >= 8){
                document.getElementById("password2").style.backgroundColor = "#52BE80"; 
            }else if(parola.match(/\d/g) && parola.match(/[A-Z]/g) && parola.match(/[a-z]/g) && parola.match(/[%]/g) && parola.length >= 8){
                document.getElementById("password2").style.backgroundColor = "#52BE80"; 
            }else if(parola.match(/\d/g) && parola.match(/[A-Z]/g) && parola.match(/[a-z]/g) && parola.match(/[#]/g) && parola.length >= 8){
                document.getElementById("password2").style.backgroundColor = "#52BE80"; 
            }else if(parola.match(/\d/g) && parola.match(/[A-Z]/g) && parola.match(/[a-z]/g) && parola.match(/[&]/g) && parola.length >= 8){
                document.getElementById("password2").style.backgroundColor = "#52BE80"; 
            }else if(parola.match(/\d/g) && parola.match(/[A-Z]/g) && parola.match(/[a-z]/g) && parola.match(/[$]/g) && parola.length >= 8){
                document.getElementById("password2").style.backgroundColor = "#52BE80"; 
            }else{
                document.getElementById("password2").style.backgroundColor = "red";
            } 
        }
    }
    
    $("#indicator").html(verific($("#password2").val()));
        
});

</script>
</div>


<?php
require $_SERVER['DOCUMENT_ROOT']."/includes/footer.php";
?>