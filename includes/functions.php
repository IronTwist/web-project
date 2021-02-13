<?php
require_once $_SERVER['DOCUMENT_ROOT']."/connection/config.php";

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


function getAllPosts($user_id){
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
        if($d["category"] == $categoryFilter){
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
    if($currentPage > 1){
        echo "<a href=\"myplace.php?page=".$previousPage."\">previousPage</a>"; 
        echo " | ";
    }
        
    if($currentPage < $pagini){
        echo "<a href=\"myplace.php?page=".$nextPage."\">nextPage</a>";
    }
    if ($currentPage != $pagini) {
        echo " | <a href=\"myplace.php?page=".$pagini."\">lastpage</a>";
    }

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
                echo "</br></br>";
                echo "<span class=\"uploadImageTitle\">".substr($img_name, 0, 26)."</span></br></br>";
                echo "File size: ".round($img_size, 2)." Mb</br>";
                echo "<a class=\"uploadedImageBtnPrew\" href=\"uploads\\".$user_name."\\".$img_name."\">Full preview</a>";
                echo "<a class=\"uploadedImageBtnDelete\" href=\"photos.php?img_id_delete=".$image_id."&img_name=".$img_name."\">Delete</a>";
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

?>