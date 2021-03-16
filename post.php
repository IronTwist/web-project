<?php
require $_SERVER['DOCUMENT_ROOT']."/includes/header.php";

if(isset($_SESSION["user"])){
    $sessionUserName = $_SESSION["user"]->getUsername();
    $sessionUserId = $_SESSION["user"]->getUser_id();

if(isset($_GET["postId"])){
    $userId = $_SESSION["user"]->getUser_id();
    $postId = $_GET["postId"];
    
    $postById = getPost($postId);

}

if(isset($_GET["deleteComment"])){
    $deleteCommId = $_GET["deleteComment"];
    $postIdComment = $_GET["postIdComment"];

    $result = Comment::deleteCommentCtr($deleteCommId);

    if($result == TRUE){
        echo "Message deleted!";
        header("Location: post.php?viewPost=$postIdComment");
    }else{
        echo "Erron on deleteing message";
    }

}

if(isset($_GET["viewPost"])){
    $postId = $_GET["viewPost"];
    $post = getPost($postId);
    
    echo "</br>";
    echo "<h1>".$post[0]["title"]."</h1>";
 
    echo "<div class=\"postDisplay\">";
    echo '<p class="showContent">'.$post[0]['content'].'</p>';
    echo "<hr>";
    echo "Time passed: ".displayWithoutZeroDates(getHowMuchTimePassed($post[0]['data']))."</br>";
    // echo "</br>";
    echo "<hr>";
    
    echo "<div>Post by ".getUserData($post[0]['id_user'], "username")."</div>";
    echo "<div>Category: ".$post[0]["category"]."</div>";
   
    echo "</div></br>";
    
    ?>
    

    <form action="/includes/comments.php" method="post">
        <span><h4>Add a comment as: <?php echo $sessionUserName; ?></h4></span></br>
        <input type="hidden" name="postId" value="<?php echo $postId; ?>" >
        <input type="hidden" name="userId" value="<?php echo $sessionUserId; ?>" >
        <div class="commentContentDiv">
        <textarea class="commentAddContent" placeholder="Your comment here..." name="comment"></textarea>
        <button class="commentAddBtn" type="submit" name="submitComment" >COMMENT</button>
        </div>
    </form>
    <?php
    
    $commentObj = new Comment($postId, $post[0]['id_user'], "");
    $comments = $commentObj->getAllCommentsForPost();
    $comments = array_reverse($comments);
    
    echo "<h4>Comments (".count($comments).") </h4></br>";
    
    ?>
    <div id="comment"></div>
    <div id="loadCommentsButton"></div>
    <?php

} //END FOR VIEW POST

if (!empty($postById)) {
    if ($userId == $postById[0]["id_user"]) {
        ?>

<section>
<div class="addPostForm">
		<h1>Edit post</h1>
	<form action="/includes/post.php" method="post">
		<input class="titleField" type="text" name="title" value="<?php echo $postById[0]["title"]; ?>" placeholder="Title here" required>
		<textarea class="textareaNoteEdit" name="postContent" wrap="soft|hard" placeholder="Content here" required><?php echo $postById[0]["content"]; ?>
        </textarea>
		<input type="hidden" id="post_id" name="post_id" value="<?php echo $postById[0]["id"]; ?>" >
		
		<div class="categoryTab">
		<label for="category" style="color: black;">Select category:</label>

		<?php $categories = getAllCategoriesOfUser($userId); ?>
			<select id="category" name="category">
			<option value="<?php echo $postById[0]["category"]; ?>" selected><?php echo $postById[0]["category"]; ?></option>
			<?php foreach ($categories as $category) {
            echo "<option value=\"$category\">$category</option>";
        } ?>

			</select>
			<input id="newCategory" type="text" placeholder="Type new category" >
			<input type="button" class="addCategBtn" onclick="addCategory(document.getElementById('newCategory'))" value="Add" >
			</br>

			<label for="publish" style="color: black;">Publish:</label>
			<select id="publish" name="publish">
                <option value="<?php echo $postById[0]["published_type"]; ?>" selected><?php echo ucfirst($postById[0]["published_type"]); ?></option>
				<option value="public" >Public</option>
				<option value="friends" >Friends</option>
				<option value="private" >Private</option>
			</select>
		</div>
		<br>
		
		<div style="width: 100%; text-align: center; margin-top: -15px;">
		<button class="addFormBtn" type="submit" name="save">Save post</button>
		<a href="myplace.php" class="addFormBtn" type="reset" >Cancel</a>
		</div>
	</form>
	</div>
    
</section>
<aside>
<div style="color: white; margin-left: 10px; border: 1px solid red; padding: 10px;">
    - To use a picture from your photos use <?php echo htmlspecialchars('<img width="100%" src="uploads/{username}/prew_{name of the picture here}.jpg">'); ?> 
    </div>
</aside>

<?php
        } else {
            //
            echo "This post it's not your's!";
        }
    }else{
        //If no post selected - END OF EDIT POST
        // header("Location: myplace.php");
    }

}else{
    //If user is not loged in do
    header("Location: login.php");
}
?>
<?php
require_once $root."/includes/footer.php";
?>
<script>
var queryString = window.location.search;
var urlParams = new URLSearchParams(queryString);
var postId = urlParams.get('viewPost');
var logedUserId = "<?php echo $_SESSION["user"]->getUser_id(); ?>";
var countComments = <?php echo count($comments); ?>;
var commentsDisplayed = 0;

window.onload = loadComments(postId);
var arrayColectat = [];

function loadComments(id){
    let comments = [];

    var request=new XMLHttpRequest();
    request.onreadystatechange=function() {
        if (request.readyState == 4)
            if (request.status == 200){

                var arr = JSON.parse(request.response);
                let numberOfObjects = arr.length;
                
                if(numberOfObjects > 0){
                    var i = 0;
                    while(i < arr.length){
                        comments.push(arr[i]);
                        i++;
                    }
                    arrayColectat = comments.reverse();
                    
                    document.getElementById("comment").innerHTML += showMessage(arr, arr.length - 1);
                    document.getElementById("comment").innerHTML += showMessage(arr, arr.length - 2);
                    document.getElementById("comment").innerHTML += showMessage(arr, arr.length - 3);
                    document.getElementById("comment").innerHTML += showMessage(arr, arr.length - 4);
  
                }else{
                    document.getElementById("loadCommentsButton").style.display = "none";
                }
            }
    }

    request.open("GET","/includes/loadComments.php?postId="+id,true);
    request.send("");

}
    
var start = 4;
var end = 8;

function loadMore(data){
    
    while(start < end){
        
        if(data[start] != undefined){
            document.getElementById("comment").innerHTML += showMessage(data, start);       
        }
        start++;
    }
    
    end  += 4;

    const foo = document.getElementById('comment');
    commentsDisplayed = foo.children.length;

    if(commentsDisplayed == countComments){
        let btn = document.getElementById("loadCommentsButton").style.display = "none";
    }
}  
 
function showMessage(objectComment, index){
    
    var returnShow = "<div class=\"comment\">";
    returnShow += "<span class=\"commentUsername\">"+objectComment[index].userName+"</span>";
    returnShow += "<span class=\"commentDatetime\">"+objectComment[index].datetime+"</span>";
    returnShow += "<p class=\"commentContent\">"+objectComment[index].comment+"</p>";
    if(objectComment[index].user_id == logedUserId){
        returnShow += "<p><a onclick=\"return confirm('Are you sure you want to delete the message?')\" class=\"btnDelete\" href=\"post.php?postIdComment="+objectComment[index].post_id+"&deleteComment="+objectComment[index].id+"\">✕</a></p>";
    }
    returnShow += "</div>";
  
    return returnShow;
}

if(countComments < 4){
        let btn = document.getElementById("loadCommentsButton").style.display = "none";
}

let btn = document.getElementById("loadCommentsButton");
btn.innerHTML = "<div style=\"text-align: center; margin-bottom: 10px;\"><button style=\"width: 300px;\" class=\"commentAddBtn\" onclick=\"loadMore(arrayColectat)\">Load more comments</button></div>";

</script>




