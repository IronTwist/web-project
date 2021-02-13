<?php
require $_SERVER['DOCUMENT_ROOT']."/includes/header.php";

if(isset($_SESSION["user"])){
    header("Location: myplace.php");
}

?>
<div class="loginMessage">
	<?php
	if(isset($_GET["message"])){
		if($_GET["message"] == 1){
			echo "<p>Your account was created, now you can login!</p>";
		}

		if($_GET["message"] == 2){
			echo "<p>Logare esuata!</p>";
		}
	}else{
		echo "";
	}	
	?>
</div>

<div class="login">
	<form action="includes/login_check.php" method="post">
	<div class="aroundField">
	</br>
	  <input type="text" id="userName" name="userName" placeholder="Username"><br><br>
	  <input type="password" id="password" name="password" placeholder="Password"><br><br></br>
	  <input id="login" type="submit" value="Login"></br>
	</div>
	</form>
	<br>
	<a href="register.php">Create account</a>
</div>
</br>	
<?php
require $_SERVER['DOCUMENT_ROOT']."/includes/footer.php";
?>