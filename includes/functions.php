<?php
require_once $_SERVER['DOCUMENT_ROOT']."/connection/config.php";

function getAllCategory($connection){
    $all_category = [];
    $sql = "SELECT * FROM category";

    $response = $connection->query($sql);

    if($response->num_rows > 0){
        while ($row = $response->fetch_assoc()) {
            if ($row["id_user"] == $_SESSION["user"]->getUser_id()) {
                array_push($all_category, $row["category"]);
            }
        }
    }

    return $all_category;
}

// function showMessages($array, $user_id){
//     for($i=0; $i < count($array); $i++){

// 	//	if($array[$i]['id_user'] === $user_id){
// 			echo $array[$i]['id']." ".$array[$i]['id_user']." : ". $array[$i]['mesaj']."</br>";
// 	//	}
// 	}
// }

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

function displayPostsWithPagination($data, $user_id, $elPerPage){

    if(!isset($_GET["page"])){
        $_GET["page"] = 1;
    }

    $numarElemente = count($data);
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
                    echo "A fost postat acum: ".getHowMuchTimePassed($postDateTime)."</br>";
                    // echo "</br>";
                    echo "<hr>";
                    echo "<br>";
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

// function insert_into_useri($user_name, $password, $name, $connection){
//     $sql = "INSERT INTO useri(userName, password, name) VALUES ('".$user_name."','".$password."','".$name."')";

//     if($connection->query($sql) === TRUE){
//         echo "User adaugat cu succes";
//     }else{
//         echo "Eroare la adaugarea user-ului";
//     }
// }

// function get_all_mesages_for_user($table, $connection, $user_id){
//     $sql = "SELECT * FROM $table WHERE id_user='".$user_id."'";
//     $result = $connection->query($sql);

//     $array = array();

// 			$index = 0;
// 			while($row = $result->fetch_assoc()){
// 				$array[$index] = $row;
// 				$index++;
// 			}

//     return $array;
// }

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

    return $dteDiff->format("%Y ani %M luni %D zile - %H ore %I minute %S secunde");
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



?>