<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."../includes/header.php";
$filter = "";
$userId = -1;

if(isset($_SESSION["user"])){
	$userId =$_SESSION["user"]->getUser_id();
}else{
	header("Location: login.php");
}

if(isset($_GET["filter"])){
	$filter = $_GET["filter"];
}


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

		<?php $categories = getAllCategoriesOfUser($userId); ?>
			<select id="category" name="category">
			<option value="Other" selected>Others</option>
			<?php foreach($categories as $category){ 
				echo "<option value=\"$category\">$category</option>";
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
		
		<div style="width: 100%; text-align: center; margin-top: -15px;">
		<button class="addFormBtn" type="submit" name="add">Add post</button>
		<button class="addFormBtn" type="reset">Cancel</button>
		</div>
	</form>
	</div>

	<article style="color: white;">
		<?php

		//Fetching all user the posts
		$posts = getAllUserPosts($userId);
		
		//using function to display all posts with page		
		myPlacePaginationPosts($posts, 4, $filter);

		?>
	</article>
</section>

<aside>
	<div class="asideFriendsonMyPLace">
		<span class="asideTitle">
			Friends
		</span>
		</br></br>
		<?php
        if (isset($_SESSION["user"])) {
            $users = getAllUsers();

            foreach ($users as $user) {
                if ($user->getUser_id() != $_SESSION["user"]->getUser_id()) { //other users 
                    
                    $frindsId = getAllFriendships($_SESSION["user"]->getUser_id()); //get all my friends id's

                    foreach ($frindsId as $friendId) {

                        if ($user->getUser_id() == $friendId) { //show if is a friend
                   ?>
                    <div class="showUserFriendOnMyPlace" style="background-image: <?php echo userProfilePic($user->getUser_id(), $user->getUserName()); ?>;">
                    <div><?php echo $user->getUserName(); ?></div></br>
                       
                    </div>  
                 <?php
                        }
                    } 
                    ?> 
                 
                 <?php  
                }// end if
            } //end foreach $users
        }else{
            header("Location: login.php");
        }
        ?>
	</div>
		</br>
	<div class="asideCategory">
		<span class="asideTitle">
			Categories
		</span>
		<br>
		<hr class="asideHr">
		<span style="margin-left: 40px;">Number of posts: <?php if(isset($_SESSION["totalNumberOfPosts"])){ echo $_SESSION["totalNumberOfPosts"]; } ?></span>
		<ul class="categoryUlFlexBox">
			<li><a href="myplace.php?filter=">All</a></li>
			<?php 
			
			$userCategorys = getAllUserCategory($posts, $userId);
			sort($userCategorys);
			foreach($userCategorys as $category){
				echo "<li><a href=\"myplace.php?filter=".$category."\">".$category."</a></li>";
			}
			
			?>
		</ul>
		</br>
	</div>
</aside>

<?php
require_once $root."/includes/footer.php";
?>



