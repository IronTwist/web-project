<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."../includes/header.php";
require_once $root."../includes/functions.php";

$filter = "";
// $numberOfPostsPerPage = 4;

if(isset($_SESSION["user"])){
    $userId = $_SESSION["user"]->getUser_id();
}

if(isset($_GET["filter"])){
	$filter = $_GET["filter"];
    $_SESSION["filter"] = $filter;
}


?>
</br>
<div>
    <h4>MyPlace users</h4>
    <div class="showUsersOnHome">
        <?php
        if (isset($_SESSION["user"])) {
            $users = getAllUsers();

            foreach ($users as $user) {
                if ($user->getUser_id() != $_SESSION["user"]->getUser_id()) {
                    ?>
                    <div class="showUser" style="background-image: <?php echo userProfilePic($user->getUser_id(), $user->getUserName()); ?>;">
                    <div class="usernameStyleDisplay"><a href="profile.php?userId=<?php echo $user->getUser_id(); ?>"><?php echo ucfirst($user->getUserName()); ?></a></div></br>
                    
                    <?php
                    $friendsId = getAllFriendships($_SESSION["user"]->getUser_id());

                    if (!empty($friendsId)) {
                        foreach ($friendsId as $friendId) {
                            if ($user->getUser_id() != $friendId) {
                                $requestSent = checkIfRequestWasSent($_SESSION["user"]->getUser_id(), $user->getUser_id());
                             
                                if($requestSent == TRUE){
                                    echo "<span class=\"friendReqSentReceived\">Friend req sent</span>";
                                }else{
                                    $requestReceive = checkIfRequestWasReceived($_SESSION["user"]->getUser_id(), $user->getUser_id());
                                   
                                    if ($requestReceive == true) {
                                        echo "<span class=\"friendReqSentReceived\">Friend req received</span>";
                                    } else {
                                        ?>
                                
                    <a class="sendFriendReqLink" href="includes/sendFriendRequest.php?userId=<?php echo $user->getUser_id(); ?>">Add Friend</a>
                       <?php
                                    }
                                }
                            }
                        }
                    }else{
                        ?>
                        <?php
                             $requestSent = checkIfRequestWasSent($_SESSION["user"]->getUser_id(), $user->getUser_id());
                             
                             if($requestSent == TRUE){
                                echo "<span class=\"friendReqSentReceived\">Friend req sent</span>";
                             }else{

                              $requestReceive = checkIfRequestWasReceived($_SESSION["user"]->getUser_id(), $user->getUser_id());
                                
                              if($requestReceive == TRUE){
                                echo "<span class=\"friendReqSentReceived\">Friend req received</span>";
                              }else{
                                  ?>
                                
                        <a class="sendFriendReqLink" href="includes/sendFriendRequest.php?userId=<?php echo $user->getUser_id(); ?>">Add Friend</a>
                     <?php
                              }//end check if request was received
                        }//end check if request was sent
                    }
                    ?>   
                 </div>  
                 
                 <?php  
                }// end if
            } //end foreach $users
        }else{
            header("Location: login.php");
        }
        ?>
    </div>
</div>
    </br>
<div class="asideCategory">
		<span class="asideTitle">
			Categories
		</span>
		<br>
        <span id="showNumberOfPosts"></span>
		<hr class="asideHr">
		<ul class="categoryUlFlexBox">
			<li><a href="home_place.php?filter=">All</a></li>
			<?php 
			
			$userCategorys = getAllCategories();
			sort($userCategorys);
			foreach($userCategorys as $category){
				echo "<li><a href=\"home_place.php?filter=".$category."\">".$category."</a></li>";
			}
			
			?>
		</ul>
		</br>
</div>

<article style="color: white;">
		<?php

		//Fetch all the posts
		$posts = getAllPosts();
		
		// using function to display all posts with page		
		homePaginationPosts($posts, 4, $filter);

		?>
        <span id="getNUmberOfPosts" style="display: none;"><?php if(isset($_SESSION["totalNumberOfPosts"])){ echo $_SESSION["totalNumberOfPosts"]; } ?> articles</span>
		
</article>

<?php
require_once $root."/includes/footer.php";
?>