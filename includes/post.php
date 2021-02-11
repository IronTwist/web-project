<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/connection/config.php";
require_once $_SERVER['DOCUMENT_ROOT']."/includes/functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(isset($_POST["title"]) && isset($_POST["postContent"])){
		$userId =$_POST["user_id"];
		$title = $_POST["title"];
		$content = $_POST["postContent"];
		$publish = $_POST["publish"];
		$category = $_POST["category"];

		
		$response = addPost($userId, $title, $content, $publish, $category, $connection);

		if($response == TRUE){
			echo "<p>Postarea a fost adaugata cu succes!</p>";
			header("Location: ../myplace.php");
		}else{
			echo "<p class=\"redMessage\">Error adding post</p";
		}
	}

}

?>