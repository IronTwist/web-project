<?php
require_once $_SERVER['DOCUMENT_ROOT']."/connection/config.php";

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

function displayPostsWithPagination($data, $user_id, $elPerPage, $categoryFilter){

    if(isset($categoryFilter) && $categoryFilter != ""){
        $data = categoryFilter($data, $categoryFilter);
    }

    if(!isset($_GET["page"])){
        $_GET["page"] = 1;
    }
    
    $numarElemente = count($data);
    $_SESSION["totalNumberOfPosts"] = $numarElemente;
    $pagini = 0;
    $elementPerPage = $elPerPage;
    $currentPage = $_GET["page"];  //pag 1
    $nextPage = 0;

    $pagini = numaraPagini($numarElemente, $elementPerPage);

    if(isset($_GET["page"])){
        $nextPage = $_GET["page"] + 1;
    }

    if(isset($_GET["page"])){
        $previousPage = $_GET["page"] - 1;
    }

    for($p = 1; $p <= $pagini; $p++){
         
        if($currentPage == $p){    
            
            $startAfisare = ($p-1) * $elementPerPage; 
            $endAfisare =$startAfisare + $elementPerPage; 
           
            while($startAfisare < $endAfisare){

                if(isset($data[$startAfisare])){
                   
                    $post = $data[$startAfisare];
                    $postDateTime = $post["data"];

                    echo "<div class=\"postDisplay\">";
                    echo "<h3>"."&emsp;".$post["title"]."</h3>";
                    echo "<hr>";
                    
                    echo '<p class="showContent">'.$post['content'].'</p>';
                    echo "<hr>";
                    echo "Data: ".getHowMuchTimePassed($postDateTime)."</br>";
                    // echo "</br>";
                    echo "<hr>";
                    
                    echo "<div>User: ".$_SESSION["user"]->getUserName()."</div>";
                    echo "<div>Category: ".$post["category"]."</div>";
                    echo "<a onclick=\"return confirm('Are you sure you want to delete this post?')\" 
                    href=\"myplace.php?clickDelete=".$post["id"]."\" id=\"btnDelete\" 
                    class=\"btnDelete\">&#x2715</a>";

                    echo "</div>";
                    
                }

                $startAfisare += 1;
            }
        }
    }

    echo "</br>";
    if ($currentPage == $pagini) {
        echo "<a href=\"home_place.php?filter=".$categoryFilter."&page=".$pagini-($pagini-1)."\">firstPage</a>  |  ";
    }

    if($currentPage > 1){
        echo "<a href=\"myplace.php?filter=".$categoryFilter."&page=".$previousPage."\">previousPage</a>"; 
        echo " | ";
    }
        
    if($currentPage < $pagini){
        echo "<a href=\"myplace.php?filter=".$categoryFilter."&page=".$nextPage."\">nextPage</a>";
    }
    if ($currentPage != $pagini) {
        echo " | <a href=\"myplace.php?filter=".$categoryFilter."&page=".$pagini."\">lastpage</a>";
    }

}

function displayPostsWithPaginationHome($data, $elPerPage, $categoryFilter){
    if(isset($categoryFilter) && $categoryFilter != ""){
        $data = categoryFilter($data, $categoryFilter);
    }

    if(!isset($_GET["page"])){
        $_GET["page"] = 1;
    }
    
    $numarElemente = count($data);
    $_SESSION["totalNumberOfPosts"] = $numarElemente;
    $pagini = 0;
    $elementPerPage = $elPerPage;
    $currentPage = $_GET["page"];  //pag 1
    $nextPage = 0;

    $pagini = numaraPagini($numarElemente, $elementPerPage);

    if(isset($_GET["page"])){
        $nextPage = $_GET["page"] + 1;
    }

    if(isset($_GET["page"])){
        $previousPage = $_GET["page"] - 1;
    }

    for($p = 1; $p <= $pagini; $p++){
         
        if($currentPage == $p){    
            
            $startAfisare = ($p-1) * $elementPerPage; 
            $endAfisare =$startAfisare + $elementPerPage; 
           
            while($startAfisare < $endAfisare){

                if(isset($data[$startAfisare])){
                   
                    $post = $data[$startAfisare];
                    $postDateTime = $post["data"];

                    echo "<div class=\"postDisplay\">";
                    echo "<h3>"."&emsp;".$post["title"]."</h3>";
                    echo "<hr>";
                    
                    echo '<p class="showContent">'.$post['content'].'</p>';
                    echo "<hr>";
                    echo "Data: ".getHowMuchTimePassed($postDateTime)."</br>";
                    // echo "</br>";
                    echo "<hr>";
                    
                    echo "<div>Post by ".getUserData($post["id_user"],"username")."</div>";
                    echo "<div>Category: ".$post["category"]."</div>";
                   
                    echo "</div>";
                    
                }

                $startAfisare += 1;
            }
        }
    }
    echo "</br>";
        ?>
        <div style="width: 100%; text-align: center;"><?php echo $currentPage." / ".$pagini ?></div>
        <?php
    echo "</br>";
    echo "<div class=\"paginationNavBar\">";
    if ($currentPage == $pagini && $elementPerPage < $numarElemente) {
        echo "<a href=\"home_place.php?filter=".$categoryFilter."&page=".$pagini-($pagini-1)."\">first-Page</a>  |  ";
    }

    if($currentPage > 1){
        echo "<a href=\"home_place.php?filter=".$categoryFilter."&page=".$previousPage."\">previous-Page</a>"; 
        echo " | ";
    }
        
    if($currentPage < $pagini){
        echo "<a href=\"home_place.php?filter=".$categoryFilter."&page=".$nextPage."\">next-Page</a>";
    }

    if ($currentPage != $pagini) {
        echo " | <a href=\"home_place.php?filter=".$categoryFilter."&page=".$pagini."\">last-page</a>";
    }
    echo "</div>";
    
}


function addPost($id_user, $title, $content, $publishedType, $category, $connection){
    $sql = "INSERT INTO posts(id_user, title, content, published_type, category) VALUES ('".$id_user."','".$title."','".$content."','".$publishedType."','".$category."')";
    echo $sql;
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

//Function to calculate time
// function dateTimeDiferenceFunction($postDateTime){
//     $split = str_split($postDateTime);

//                 $anul = $split[0].$split[1].$split[2].$split[3];
//                 $luna = $split[5].$split[6];
//                 $ziua = $split[8].$split[9];
//                 $ora = $split[11].$split[12];
//                 $min = $split[14].$split[15];
//                 $sec = $split[17].$split[18];

//                 // print_r($split);

//                 echo $anul." ".$luna." ".$ziua." ".$ora." ".$min." ".$sec;

//                 echo "</br>";
//                 $nowDateTime =new DateTime("now");
//                 $currentDateTime = $nowDateTime->format('Y-m-d H:i:s');

//                 $splitCurrent = str_split($currentDateTime);

//                 $anulCurrent = $splitCurrent[0].$splitCurrent[1].$splitCurrent[2].$splitCurrent[3];
//                 $lunaCurrent = $splitCurrent[5].$splitCurrent[6];
//                 $ziuaCurrent = $splitCurrent[8].$splitCurrent[9];
//                 $oraCurrent = $splitCurrent[11].$splitCurrent[12]; //+ 1 ora
//                 $minCurrent = $splitCurrent[14].$splitCurrent[15];
//                 $secCurrent = $splitCurrent[17].$splitCurrent[18];

//                 // print_r($currentDateTime);

//                 echo $anulCurrent." ".$lunaCurrent." ".$ziuaCurrent." ".$oraCurrent." ".$minCurrent." ".$secCurrent;
// }

function currentYearString(){
    $nowDateTime =new DateTime("now");
                $currentDateTime = $nowDateTime->format('Y-m-d H:i:s');

                $splitCurrent = str_split($currentDateTime);

                $anulCurrent = $splitCurrent[0].$splitCurrent[1].$splitCurrent[2].$splitCurrent[3];
                $lunaCurrent = $splitCurrent[5].$splitCurrent[6];
                $ziuaCurrent = $splitCurrent[8].$splitCurrent[9];
                $oraCurrent = $splitCurrent[11].$splitCurrent[12]; 
                $oraCurrent = $oraCurrent + 1;//+ 1 ora
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

    return $dteDiff->format("%YY %Ml %Dz - %HH %Im %Ss");
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
        return "url(uploads/".$userName."/".$pictureName.")";
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

?>