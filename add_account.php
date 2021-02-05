<?php
require_once("includes/header.php");

?>

<div class="addAccountDiv">
<?php
    

if(isset($_GET["actionResponse"])){
    if($_GET["actionResponse"] == 1){
        echo "<p style=\"color: blue;\">New user account succesfully created!</p>";
    }else{
        echo "<p class=\"redMessage\">Some error ocured, try again! Make sure all fields are completed!</p>";
    }
}

?>
<form action="includes/add_account_functions.php" method="post">
	  <!-- <label for="userName">Username:</label> -->
      <input type="text" id="userName" name="userName" placeholder="User name"><br><br>
      
	  <!-- <label for="password">Password:</label> -->
      <input type="password" id="password" name="password" placeholder="Password"><br><br>

      <!-- <label for="lastName">Last name:</label> -->
      <input type="lastName" id="lastName" name="lastName" placeholder="Last name"><br><br>

      <!-- <label for="firstName">First name:</label> -->
      <input type="firstName" id="firstName" name="firstName" placeholder="First name"><br><br>
      
	  <input type="submit" class="create_account" value="Create">
    </form>
    <a href="login.php">Back</a>
</div>

<?php
require_once("includes/footer.php");
?>