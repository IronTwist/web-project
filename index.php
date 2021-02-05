<?php
	require_once "../MyWebsite/includes/header.php";
	
	if(isset($_SESSION["logat"])){
		header("Location: action_page.php");
	}else{
		header("Location: login.php");
	}

	require_once("includes/footer.php");
?>