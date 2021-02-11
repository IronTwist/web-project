<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."../includes/header.php";

$userId =$_SESSION["user"]->getUser_id();

?>
<section>
	<div class="addPostForm">
		<!-- <p>Add new post</p> -->
	<form action="/includes/post.php" method="post">
		<input class="titleField" type="text" name="title" placeholder="Title here" required>
		<textarea class="textareaNote" name="postContent" wrap="soft|hard" placeholder="Content here" required></textarea>
		<input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION["user"]->getUser_id();  ?>" >
		
		<div class="categoryTab">
		<label for="category" style="color: black;">Select category:</label>

		<?php $category = getAllCategory($connection); ?>
			<select id="category" name="category">
			<option value="Other" selected>Others</option>
			<?php for($i=0; $i<sizeof($category); $i++ ){ 
				echo "<option value=\"$category[$i]\">$category[$i]</option>";
			}?>
			</select>
			<input id="newCategory" type="text" placeholder="Type new category" >
			<input type="button" class="addCategBtn" onclick="addCategory(document.getElementById('newCategory'))" value="Add" >
			</br>
			<label for="publish" style="color: black;">Publish:</label>
			<select id="publish" name="publish">
				<option value="public" selected>Public</option>
				<option value="friends" >Friends Only</option>
				<option value="private" >Private</option>
			</select>
		</div>
		<br>
		
		<div style="width: 100%; text-align: center;">
		<button class="addFormBtn" type="submit" name="add">Add post</button>
		<button class="addFormBtn" type="reset">Cancel</button>
		</div>
	</form>
	</div>

	<article style="color: white;">
		<?php

		//Fetching all the posts
		$posts = getAllPosts($userId);
		
		//using function to display all posts with page
		displayPostsWithPagination($posts, $userId, 4);


		?>
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

require_once $root."/includes/footer.php";
?>



