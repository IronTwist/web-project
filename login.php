<?php
require $_SERVER['DOCUMENT_ROOT']."/includes/header.php";

if(isset($_SESSION["user"])){
    header("Location: myplace.php");
}

?>

<div class="login">
	<form action="includes/login_check.php" method="post">
	 
	  <input type="text" id="userName" name="userName" placeholder="Username"><br><br>
	  
	  <input type="password" id="password" name="password" placeholder="Password"><br><br>
	  <input type="submit" class="loginBtn" value="Login">
	</form>
	<br>
	<a href="add_account.php">Create account</a>
	
</div>	
<?php
require $_SERVER['DOCUMENT_ROOT']."/includes/footer.php";
?>