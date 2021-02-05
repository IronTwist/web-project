<?php
require_once("includes/header.php");
if(isset($_SESSION["user"])){
    header("Location: action_page.php");
}

?>


<script type="text/javascript">

    if(getQueryVariable("error") == 1){
        alert("Userul sau parola introdusa nu este valida!");
    }
</script>
<div class="login">
	<form action="includes/login_check.php" method="post">
	  <!-- <label for="userName">Username:</label> -->
	  <input type="text" id="userName" name="userName" placeholder="Username"><br><br>
	  <!-- <label for="password">Password:</label> -->
	  <input type="password" id="password" name="password" placeholder="Password"><br><br>
	  <input type="submit" class="loginBtn" value="Login">
	</form>
	<br>
	<a href="add_account.php">Create account</a>
	<a href="sesiune.php">sesiune</a>
</div>	
<?php
require_once("includes/footer.php");
?>