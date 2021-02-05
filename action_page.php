<?php
require_once "../MyWebsite/includes/header.php";
include "../MyWebsite/includes/pagination.class.php";
include "includes/navigation.php";

$user = ""; 
$user_id = "";

if(isset($_SESSION["user"])){
	$user = $_SESSION["user"];
	$user_id = $_SESSION["user_id"];

	$welcomeUser = "<h4> Welcome back, <span class=\"welcomeUser\">".$user."</span></br></br></h4>";
	echo $welcomeUser;

	
	$postareField = "<form action\"includes/postare.php\" method=\"post\">";
	$postareField .= "<div class=\"postareField\">";
	$postareField .= "<div class=\"aroundNoteForm\">";
	$postareField .= "<input class=\"titleField\" type=\"text\" name=\"titlu\" placeholder=\"Title here\">";
	$postareField .= "<textarea class=\"textareaNote\" name=\"message\" placeholder=\"Content here\"></textarea>";
	$postareField .= "<input type=\"hidden\" id=\"user_id\" name=\"user_id\" value=\"".$user_id."\">";
	$postareField .= "<input type=\"submit\" class=\"addNoteBtn\" value=\"Add post\">";
	$postareField .= "</div>";
	$postareField .= "</form>";
	$postareField .= "</div>";

	print $postareField;

	if(isset($_POST["message"]) && isset($_POST["user_id"])){
		$message = $_POST["message"];
		$user_id = $_POST["user_id"];
		$titlu = $_POST["titlu"];

		if(empty(trim($message))){
			echo "<p class=\"redMessage\"> Atentie continutul e gol!</p>";
			header("Location: action_page.php");
		}else if(empty(trim($titlu))){
			echo "<p class=\"redMessage\"> Atentie	lipseste titlul!</p>";
			header("Location: action_page.php");
		}else{
			insert_into_mesaje($user_id, $titlu, str_replace("'","\'",$message), $connection);
		}
	}
	
	$array_mesaje_from_user = get_all_mesages_for_user("mesaje", $connection, $user_id);
	$array_mesaje_from_user = array_reverse($array_mesaje_from_user);

	paginationMessages($array_mesaje_from_user, $user_id, 8);

}else{

	echo "Nu esti logat! </br>";
	echo "<a href=\"index.php\" >Back</a>";
}

require_once "includes/footer.php";
?>



