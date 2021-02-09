<?php
	require "includes/header.php";
	
	if(isset($_SESSION["logat"])){
		header("Location: myplace.php");
	}else{
		header("Location: login.php");
	}

	require "includes/footer.php";
?>