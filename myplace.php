<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root."../includes/header.php";
require $root."/includes/pagination.class.php";

?>

<section>
	<div class="addPostForm">
		<!-- <p>Add new post</p> -->
	<form action="includes/addPost.php" method="post">
		<input class="titleField" type="text" name="title" placeholder="Title here" required>
		<textarea class="textareaNote" name="postContent" wrap="soft|hard" placeholder="Content here" required></textarea>
		<input type="hidden" id="user_id" name="user_id" value="<?php $user_id ?>" >
		
		<div class="categoryTab">
		<label for="category" style="color: black;">Select category:</label>
			<select id="category" name="category">
				<option value="#" selected disabled>Category</option>
				<option value="IT">IT</option>
				<option value="Books">Books</option>
				<option value="Category2">Category2</option>
				<option value="Category3">Category3</option>
			</select>
			<input id="newCategory" type="text" placeholder="Type new category" >
			<input type="button" class="addCategBtn" onclick="addCategory(document.getElementById('newCategory'))" value="Add" >
		</div>
		<br>
		
		<div style="width: 100%; text-align: center;">
		<button class="addFormBtn" type="submit" name="add">Add post</button>
		<button class="addFormBtn" type="reset">Cancel</button>
		</div>
	</form>
	</div>

	<article>
		asd
	</article>
</section>

<aside>
	aici prieteni, postari pe date, etc
</aside>

<?php
// $user = ""; 
// $user_id = "";

// if(isset($_SESSION["user"])){
// 	$user = $_SESSION["user"];
// 	$user_id = $_SESSION["user_id"];

// 	$welcomeUser = "<h4> Welcome back, <span class=\"welcomeUser\">".$user."</span></br></br></h4>";
// 	echo $welcomeUser;

	


	// if(isset($_POST["message"]) && isset($_POST["user_id"])){
		// $message = $_POST["message"];
		// $user_id = $_POST["user_id"];
		// $titlu = $_POST["titlu"];

		// if(empty(trim($message))){
		// 	echo "<p class=\"redMessage\"> Atentie continutul e gol!</p>";
		// 	header("Location: myplace.php");
		// }else if(empty(trim($titlu))){
		// 	echo "<p class=\"redMessage\"> Atentie	lipseste titlul!</p>";
		// 	header("Location: myplace.php");
		// }else{
		// 	insert_into_mesaje($user_id, $titlu, str_replace("'","\'",$message), $connection);
		// }
	// }
	
// 	$array_mesaje_from_user = get_all_mesages_for_user("mesaje", $connection, $user_id);
// 	$array_mesaje_from_user = array_reverse($array_mesaje_from_user);

// 	paginationMessages($array_mesaje_from_user, $user_id, 8);

// }else{

// 	echo "Nu esti logat! </br>";
// 	echo "<a href=\"index.php\" >Back</a>";
// }

require $root."/includes/footer.php";
?>



