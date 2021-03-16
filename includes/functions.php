<?php
require_once $_SERVER['DOCUMENT_ROOT']."/connection/config.php";
require_once $_SERVER['DOCUMENT_ROOT']."/includes/classes/Pagination.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/includes/classes/Comment.class.php";

function filterInput($data)
  {
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

function getAllCategories(){
    global $connection;
    $all_category = [];
    $sql = "SELECT * FROM posts";
    
    $response = $connection->query($sql);

    if($response->num_rows > 0){
        while ($row = $response->fetch_assoc()) {
    
            array_push($all_category, $row["category"]);
        }
    }
    $all_category = array_unique($all_category);
    sort($all_category);

    return $all_category;
}

function getAllCategoriesOfUser($userId){
    global $connection;
    $all_category = [];
    $sql = "SELECT * FROM posts WHERE id_user='".$userId."'";
    
    $response = $connection->query($sql);

    if($response->num_rows > 0){
        while ($row = $response->fetch_assoc()) {
    
            array_push($all_category, $row["category"]);
        }
    }
    $all_category = array_unique($all_category);
    sort($all_category);

    return $all_category;
}

function getAllPosts(){
    global  $connection;
    $posts = [];

    $sql = "SELECT * FROM posts";
    $result = $connection->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            array_push($posts, $row);
        }
    }
    $posts = array_reverse($posts); //to get last inserted first
    return $posts;
}

function getPost($id){
    global  $connection;
    $post = [];

    $sql = "SELECT * FROM posts WHERE id=$id";
    $result = $connection->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            array_push($post, $row);
        }
    }
    
    return $post;
}


function getAllUserPosts($user_id){
  global  $connection;
  $posts = [];

  $sql = "SELECT * FROM posts WHERE id_user='".$user_id."'";
  $result = $connection->query($sql);

  if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
          array_push($posts, $row);
      }
  }
  $posts = array_reverse($posts);
  return $posts;
}

function getAllPublicPosts(){
    global $connection;
    $posts = [];

    $sql = "SELECT view_posts.id, view_posts.title, view_posts.content, view_posts.published_type, view_posts.category, view_posts.data, users.userName
    FROM
        view_posts
    INNER JOIN users
    ON view_posts.id_user = users.id
    WHERE
        published_type = 'public'";
    
    $result = $connection->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            array_push($posts, $row);
        }
    }
    $posts = array_reverse($posts);
    return $posts;
}

function numaraPagini($numarElemente, $elPerPage){
    $countPagini = 0;
    for($i = 0; $i < $numarElemente; $i++){
        if($i % $elPerPage == 0 ){
            $countPagini++;
        }
    }

    $pagini = $countPagini;
    return $pagini;
}

function categoryFilter($data, $categoryFilter){
    $array = [];

    foreach($data as $d){
        if($d["category"] === $categoryFilter){
            array_push($array, $d);
        }
    }

    return $array;
}

function loginPaginationPosts($data, $elPerPage){
    $publicPostsPaginatin = new Pagination;
    $publicPostsPaginatin->displayPublicPostsWithPagination($data, $elPerPage);
}

function myPlacePaginationPosts($data, $elPerPage, $categoryFilter){

    $myPlacePagination = new Pagination;
    $myPlacePagination->displayPostsWithPagination($data, $elPerPage, $categoryFilter);
}

function homePaginationPosts($data, $elPerPage, $categoryFilter){

    $homePagination = new Pagination;
    $homePagination->displayPostsWithPaginationHome($data, $elPerPage, $categoryFilter); 
}

function searchPaginationPosts($data, $elPerPage, $categoryFilter, $stringSearch ){

    $searchPagination = new Pagination;
    $searchPagination->searchPostsWithPagination($data, $elPerPage, $categoryFilter, $stringSearch);
}

function addPost($id_user, $title, $content, $publishedType, $category, $connection){
    $sql = "INSERT INTO posts(id_user, title, content, published_type, category) VALUES ('".$id_user."','".$title."','".$content."','".$publishedType."','".$category."')";
    
    if($connection->query($sql) === TRUE){
        return TRUE;
    }else{
        return FALSE;
    }
}

function updatePost($id_post, $title, $content, $publishedType, $category, $connection){
    
    $sql = "UPDATE posts SET title='$title', content='$content', published_type='$publishedType', category='$category' WHERE id='$id_post'"; 
    
    if($connection->query($sql) === TRUE){
        return TRUE;
    }else{
        return FALSE;
    }
}


function getAllUserCategory($posts, $userId){
    $categorys = [];
    
    foreach($posts as $post){
        if($post["id_user"] == $userId && $post["category"] != ""){
            array_push($categorys, trim($post["category"]));
        }
    }

    $categorys = array_unique($categorys);
    $categorys = array_reverse($categorys);
    return $categorys;
}


function get_all_images_for_user($table, $connection, $user_id){
    $sql = "SELECT * FROM $table WHERE user_id='".$user_id."'";
    $result = $connection->query($sql);

    $array = array();

			$index = 0;
			while($row = $result->fetch_assoc()){
				$array[$index] = $row;
				$index++;
			}

    return $array;
}

if(isset($_GET['clickDelete'])){
    delete_message($connection, $_GET["clickDelete"]);
    unset($_GET['clickDelete']);
}

function delete_message($connection, $id){
    
    $sql = "DELETE FROM posts WHERE id='".$id."'";

    if($connection->query($sql) === TRUE){
        header("Location: ../myplace.php");
    }else{
        echo "No post deleted";
    }
}

function currentYearString(){
    $nowDateTime =new DateTime("now");
                $currentDateTime = $nowDateTime->format('Y-m-d H:i:s');

                $splitCurrent = str_split($currentDateTime);

                $anulCurrent = $splitCurrent[0].$splitCurrent[1].$splitCurrent[2].$splitCurrent[3];
                $lunaCurrent = $splitCurrent[5].$splitCurrent[6];
                $ziuaCurrent = $splitCurrent[8].$splitCurrent[9];
                $oraCurrent = $splitCurrent[11].$splitCurrent[12]; 
                $oraCurrent = $oraCurrent + 1;//+ 1 hour
                $minCurrent = $splitCurrent[14].$splitCurrent[15];
                $secCurrent = $splitCurrent[17].$splitCurrent[18];

                // print_r($currentDateTime);

                return $anulCurrent."-".$lunaCurrent."-".$ziuaCurrent." ".$oraCurrent.":".$minCurrent.":".$secCurrent;
}

function getHowMuchTimePassed($postDateTime){
    $strStart = $postDateTime;
    $strEnd   = currentYearString(); 
    
    $dteStart = new DateTime($strStart);
    $dteEnd   = new DateTime($strEnd); 

    $dteDiff  = $dteStart->diff($dteEnd); 

    return $dteDiff->format("%y Year -%m Month -%d Days -%h Hours -%i Minutes -%s Seconds");
}

function displayWithoutZeroDates($dateString){
    $dataExplode = explode("-", $dateString);
    $collect = [];
    
    for($i = 0; $i < count($dataExplode); $i++){
        if(!strStartsWith($dataExplode[$i], "0")){
            array_push($collect, $dataExplode[$i]);
        }
    }
   
    return implode("",$collect);
}

function strStartsWith($string, $flag){
	if($string[0] == $flag){
		return true;	
	}
	return false;
}

function makeDirForUpload($user){
    $userPathString = "uploads/".$user."/";
    if(!file_exists($userPathString)){
        mkdir($userPathString);
    }
}

function removeDirForUpload($user){
    $userPathString = "uploads/".$user."/";
    if(!file_exists($userPathString)){
        rmdir($userPathString);
    }
}


function showUploadedImages($user_name, $user_id){
    global $connection;

    $sql = "SELECT * FROM images_upload";

    $res = $connection->query($sql);

    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $image_id = $row["id"];
            $img_name = $row["name"];
            $img_user_id = $row["user_id"];
            $img_size = $row["size"];

            if($img_user_id === $user_id){
                echo "<div class=\"uploadImageDiv\">";
                
                echo "<img class=\"uploadImage\" src=\"uploads\\".$user_name."\\prew_".$img_name."\" >";

                echo "<div class=\"uploadImageTitle\">".substr($img_name, 0, 26)."</div>";
                echo "<div>File size: ".round($img_size, 2)." Mb</div>";
                echo "<div class=\"photoNavBtns\">";
                echo "<a class=\"uploadedImageBtn\" href=\"uploads\\".$user_name."\\".$img_name."\">Full preview</a>";
                echo "<a class=\"uploadedImageBtn\" href=\"photos.php?img_id_delete=".$image_id."&img_name=".$img_name."\">Delete</a>";
                echo "<a class=\"uploadedImageBtn\" href=\"photos.php?profile_set_img=".$img_name."\">Set as profile</a>";
                echo "</div>";
                echo "</div>";
            }
        }
    }
}

function deleteUploadedImage($image_id, $user_name, $img_name){
    $sql = "DELETE FROM images_upload WHERE id=$image_id";
    global $connection;

    if($connection->query($sql) === TRUE){
        $path = "uploads/".$user_name."/".$img_name;
        $path_prew = "uploads/".$user_name."/prew_".$img_name;

        if (file_exists($path)){
           unlink($path);
           unlink($path_prew);
        }else{
            echo "Nu a mers";
        }

        header("Location: photos.php");
    }
}


function removeEmptySubFolders($path)
{
  $empty=true;
  foreach (glob($path.DIRECTORY_SEPARATOR."*") as $file)
  {
     $empty &= is_dir($file) && RemoveEmptySubFolders($file);
  }
  return $empty && rmdir($path);
}

function getUserLogoPic($userId){
    global $connection;
    $sql = "SELECT * FROM profile_pic WHERE user_id='".$userId."'";

    $result = $connection->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        return $row["picture"];
    }else{
        return "";
    }
}

function replaceSpaceWithBackslash($string){
    $string = trim($string);
    $returnString = "";
    for($i = 0; $i < strlen($string); $i++){
        if($string[$i] == " "){
            $returnString .= "\ ";
        }else{
            $returnString .= $string[$i]; 
        }
    }

    return $returnString;
}

function getAllUsers(){
    global $connection;
    $users = [];

    $sql = "SELECT * FROM users";

    $result = $connection->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $user = new User(
                $row["id"],
                $row["userName"], $row["password"], $row["email"], $row["first_name"], $row["last_name"], $row["sex"],
                $row["registerDate"], $row["userRole"], $row["birthday"], $row["country"], $row["city"], $row["about"]
            );

            array_push($users, $user);
        }
    }

    return $users;
}

function getUser($id){
    global $connection;
    $user = null;

    $sql = "SELECT * FROM users WHERE id=$id";

    $result = $connection->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $user = new User(
                $row["id"],
                $row["userName"], $row["password"], $row["email"], $row["first_name"], $row["last_name"], $row["sex"],
                $row["registerDate"], $row["userRole"], $row["birthday"], $row["country"], $row["city"], $row["about"]
            );     
        }
    }

    return $user; 
}

function getUserProfile($id){
    $user = getUser($id);
    $user->setPassword(null);
    return $user;
}

function createUserProfilePic($user_id){
    global $connection;

    $sql = "INSERT INTO profile_pic(user_id, picture) VALUES ($user_id, 'none')";
    $connection->query($sql);

}


function userProfilePic($user_id, $userName){
    global $connection;

    $sql = "SELECT picture FROM profile_pic WHERE user_id=$user_id";

    $result = $connection->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $pictureName = replaceSpaceWithBackslash($row["picture"]);
        return "url(uploads/".$userName."/prew_".$pictureName.")";
    }

    return "";
}

function getRequestsReceived($user_id_to_check){
    global $connection;
    $userIdsSender = [];

    $sql = "SELECT * FROM friend_request WHERE friend_id_receiver=$user_id_to_check";
   
    $response = $connection->query($sql);

    if($response->num_rows > 0){
        while($row = $response->fetch_assoc()){
            if ($row["request_approved"] == 0) {
                // array_push($userIdsSender, $row["user_id_sender"]);
                array_push($userIdsSender, $row);
            }
        }
    }

    return $userIdsSender;
}

function acceptUserFriendship($userIdFriend, $myUserId, $accept_flag){
    global $connection;

    $sql = "SELECT * FROM friend_request WHERE user_id_sender=$userIdFriend AND friend_id_receiver=$myUserId";
    
    $response = $connection->query($sql);

    if($response){
        $row = $response->fetch_assoc();
        
        if (isset($row["id"])) {
            $id = $row["id"];
            if ($row["request_approved"] == false && $accept_flag == "ACCEPT") {
                $sqlUpdate = "UPDATE friend_request SET request_approved=true WHERE id=$id";
               
                $connection->query($sqlUpdate);
                updateFrindshipConnection($myUserId, $userIdFriend, $accept_flag);
            }

            if ($row["request_approved"] == false && $accept_flag == "REMOVE") {
               
                updateFrindshipConnection($myUserId, $userIdFriend, $accept_flag);
            }
        }
    }
}

//add friendship connection
/**
 * String $accept_flag = "ACCEPT" / "REMOVE"
 *
 * @param [type] $user_id
 * @param [type] $friend_id
 * @param String $accept_flag 
 * @return void
 */
function updateFrindshipConnection($user_id, $friend_id, $accept_flag){
    global $connection;

    if ($accept_flag == "ACCEPT") {
        $sql = "INSERT INTO friends(user_id, friend_id) VALUES ($user_id, $friend_id)";

        $connection->query($sql);

        $sql = "INSERT INTO friends(user_id, friend_id) VALUES ($friend_id, $user_id)";

        $connection->query($sql);
    }

    if($accept_flag == "REMOVE"){
        // DELETE requests
        $sql = "DELETE FROM friend_request WHERE user_id_sender=$friend_id AND friend_id_receiver=$user_id";
        $connection->query($sql);

        $sql = "DELETE FROM friend_request WHERE user_id_sender=$user_id AND friend_id_receiver=$friend_id";
        $connection->query($sql);
    }

}

function getAllFriendships($user_id){
    global $connection;
    $friendsId = [];

    $sql = "SELECT * FROM friends WHERE user_id=$user_id";

    $result = $connection->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
           
            array_push($friendsId, $row["friend_id"]);

        }
    }
    
    return $friendsId;
}

function removeFriend($user_id, $friend_id){
    global $connection;

    //Delete all possible connections 

    $sql = "DELETE FROM friends WHERE user_id=$user_id AND friend_id=$friend_id";
    $connection->query($sql);

    $sql = "DELETE FROM friends WHERE user_id=$friend_id AND friend_id=$user_id";
    $connection->query($sql);

    //Delete all possible requests between users

    $sql = "DELETE FROM friend_request WHERE user_id_sender=$friend_id AND friend_id_receiver=$user_id";
    $connection->query($sql);

    $sql = "DELETE FROM friend_request WHERE user_id_sender=$user_id AND friend_id_receiver=$friend_id";
    $connection->query($sql);

}

function checkIfRequestWasSent($myUserId, $userIdFriend){
    global $connection;

    $sql = "SELECT * FROM friend_request WHERE user_id_sender=$myUserId AND friend_id_receiver=$userIdFriend";
    
    $result = $connection->query($sql);
    
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if($row["send_request_friend"] == TRUE && $row["request_approved"] == FALSE){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    return FALSE;
}

function checkIfRequestWasReceived($myUserId, $userIdFriend){
    global $connection;

    $sql = "SELECT * FROM friend_request WHERE user_id_sender=$userIdFriend AND friend_id_receiver=$myUserId";
    
    $result = $connection->query($sql);
    
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if($row["send_request_friend"] == TRUE && $row["request_approved"] == FALSE){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    return FALSE;
}

function setImageAsProfilePhoto($userId, $picName){
    global $connection;

    $sql = "UPDATE profile_pic SET picture='$picName' WHERE user_id=$userId";
    
    $res = $connection->query($sql);
    if($res){
        $_SESSION["logo_pic"] = $picName;
        header("Location: photos.php");
    }else{
        header("Location: photos.php");
    }
}

function getUserData($id_user, $flag){
    global $connection;
    $returnString = "";

    $sql = "SELECT * FROM users WHERE id=$id_user";
    
    $res = $connection->query($sql);

    if($res->num_rows > 0){
        $row = $res->fetch_assoc();

        if ($flag === "email") {
            $returnString = $row["email"];
            return $returnString;
        }

        if ($flag === "first_name") {
            $returnString = $row["first_name"];
            return $returnString;
        }

        if ($flag === "username") {
            $returnString = $row["userName"];
            return $returnString;
        }

        
    }

    return "";
}

function searchPosts($string){
    global $connection;
    $string = filterInput($string);
    $searchWords = explode(" ", $string);

    $posts = [];
    for($i=0; $i < count($searchWords); $i++){
        $word = $searchWords[$i];

        $sql = "SELECT * FROM `view_posts` WHERE `title` LIKE '%$word%' OR
                                                `content` LIKE '%$word%' OR 
                                                `category` LIKE '%$word%'";

        $res = $connection->query($sql);

        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                array_push($posts, $row);
            }
        }
    }
    //to remove my unique values
    $posts = array_unique($posts, SORT_REGULAR);
    
    return $posts;
}

function showProfile($id_user, $flag){
    global $connection;

    $sql = "SELECT * FROM view_user WHERE id=$id_user";
    $response = $connection->query($sql);

    if ($response->num_rows > 0) {
        $row = $response->fetch_assoc();

            ?>
<div class="profileUserStyle">
    <p>
        <img width="100%" style="border-radius: 1em;"
        src="/uploads/<?php echo $row["userName"]; ?>/<?php echo "prew_". $row["picture"]; ?>" alt="logoPic" >
    </p>
    <p>Username: <?php echo $row["userName"]; ?></p>
    <p>First name: <?php echo $row["first_name"]; ?></p>
    <p>Last name: <?php echo $row["last_name"]; ?></p>
    <p>Birthdate: <?php echo $row["birthday"]; ?></p>
    <p>Register date/time: <?php echo $row["registerDate"]; ?></p>
    <p>Country: <?php echo $row["country"]; ?></p>
    <p>City: <?php echo $row["city"]; ?></p>
    <p>Sex: <?php

    $sex = $row["sex"];
            ;
            if ($sex == 1) {
                echo "male";
            } elseif ($sex == 2) {
                echo "female";
            } else {
                echo "other";
            } ?></p>
    
    <p>About me: <?php echo $row["about"]; ?></p>
    
 <?php 
    if($flag == "user"){
        echo "<a class=\"editBtnProfile\" href=\"profile.php?editUser=".$row["id"]."\">Edit Profile</a>";
    }
 
 ?>
    
</div>

<?php
    }else{
        echo "No user to show! Please login!";
    }
}

function editProfile($userId){

    $user = getUser($userId);

    ?>
    </br>
    <a class="editBtnProfile" href="profile.php">Go Back</a></br>
    <form action="" method="POST" enctype="multipart/form-data" >
    <div class="centralForm">
        
        <div class="aroundField">
            <label class="registerLabel" for="username">Username:</label><br>
            <input class="inputField" type="text" id="username" name="username" value="<?php echo $user->getUserName(); ?>" ><br>
        </div>
        
        <div class="aroundField">
       
        <label class="registerLabel" for="fname">First name:</label><br>
        <input class="inputField" type="text" id="fname" name="fname" value="<?php echo $user->getFirstName(); ?>" placeholder="e.g. Connor"><br>
    
        <label class="registerLabel" for="lname">Last name:</label><br>
        <input class="inputField" type="text" id="lname" name="lname" value="<?php echo $user->getLastName(); ?>" placeholder="e.g. John"><br>

        <label class="registerLabel" for="sex">Sex:</label><br>
            <input type="radio" id="male" name="sex" value="1" <?php if($user->getSex() == 1){echo "checked";} ?>>
            <label for="male">male</label>
            <input type="radio" id="female" name="sex" value="2" <?php if($user->getSex() == 2){echo "female";} ?>>
            <label for="female">female</label></br>

        <label class="registerLabel" for="birthday">Birthday:</label><br>
        <input type="date" id="birthday" name="birthday" value="<?php echo $user->getBirthday(); ?>"><br></br>
        </div>

        <div class="aroundField">
            <label class="registerLabel" for="country">Country:</label><br>
            <input type="text" id="country" name="country" value="<?php echo $user->getCountry(); ?>" placeholder="Type country"><br>

            <label class="registerLabel" for="city">City:</label><br>
            <input type="text" id="city" name="city" value="<?php echo $user->getCity(); ?>" placeholder="Type city"><br>

            <label class="registerLabel" for="username">About:</label><br>
            <textarea class="about" name="about" placeholder="Add extra info, e.g. hobbies"><?php echo $user->getAbout(); ?></textarea>
        </div>
        </br>
        <button id="reset" type="reset">Reset</button></br></br>
        <input id="submit" type="submit" name="submit" value="Save">
    </div>
</form>

    <?php
}

?>