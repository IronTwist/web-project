<?php
require_once("pagination.class.php");

if(isset($_POST["name"])){
    $nameUpdate = htmlentities($_POST["name"]);
    $surnameUpdate = htmlentities($_POST["surname"]);
    $userId = htmlentities($_SESSION["user_id"]);

    echo "new name ".$nameUpdate;

    $sqlUpdate = "UPDATE useri SET name = '$nameUpdate', prenume= '$surnameUpdate' WHERE id = $userId";
    if($connection->query($sqlUpdate) == TRUE){
        echo "Succesfully updated!";
        header("Location: user_account.php");
        $_SESSION["name"] = $nameUpdate;
        $_SESSION["surname"] = $surnameUpdate;
    }else{
        echo "Error";
    }
}

if(isset($_GET["delete"])){
    $user_id = $_GET["user_id"];
    deleteAccount($user_id);

    $folderPath = "uploads/".$_SESSION["user"]."/";
    $files = glob($folderPath.'/*');

    foreach($files as $file){
        if(is_file($file)){
            unlink($file);
        }
    }

    removeEmptySubFolders("uploads/");

    $sqlDeletePicturesForUser = "DELETE FROM images_upload WHERE user_id=$user_id";
    $connection->query($sqlDeletePicturesForUser);

    $sqlDeleteMessagesUser = "DELETE FROM mesaje WHERE id_user=$user_id";
    $connection->query($sqlDeleteMessagesUser);

    session_start();
    session_destroy();
    header('Location: login.php');
    exit;
    
}

if(isset($_GET["img_id_delete"])){
    $img_id = $_GET["img_id_delete"];
    $img_name = $_GET["img_name"];

    deleteUploadedImage($img_id, $_SESSION["user"], $img_name);
    header('Location: user_account.php');
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

//My old function without pagination display
// function showUploadedImages($user_name, $user_id, $connection){
//     $sql = "SELECT * FROM images_upload";

//     $res = $connection->query($sql);

//     if($res->num_rows > 0){
//         while($row = $res->fetch_assoc()){
//             $image_id = $row["id"];
//             $img_name = $row["name"];
//             $img_user_id = $row["user_id"];
//             $img_size = $row["size"];

//             if($img_user_id === $user_id){
//                 echo "<div class=\"uploadImageDiv\">";
//                 echo "File name: ". $img_name."</br></br>";
//                 echo "<img class=\"uploadImage\" src=\"includes\uploads\\".$user_name."\\prew_".$img_name."\" >";
//                 echo "</br></br>";
//                 echo "File size: ".round($img_size, 2)." Mb</br>";
//                 echo "<a class=\"uploadedImageBtn\" href=\"includes\uploads\\".$user_name."\\".$img_name."\">Full preview</a>";
//                 echo "<a class=\"uploadedImageBtn\" href=\"user_account.php?img_id_delete=".$image_id."&img_name=".$img_name."\">Delete</a>";
//                 echo "</div>";
//             }
//         }
//     }
// }


// modified with pagination
function showUploadedImages($array, $user_id, $show_per_page, $user_name){
   
    if (count($array)) {
                // Create the pagination object
                $pagination = new pagination($array, (isset($_GET['page']) ? $_GET['page'] : 1), $show_per_page);
                // Decide if the first and last links should show
                $pagination->setShowFirstAndLast(false);
                // You can overwrite the default seperator
                $pagination->setMainSeperator(' | ');
                // Parse through the pagination class
                $messagePages = $pagination->getResults();
                // If we have items 
                if (count($messagePages) != 0) {
                  // Create the page numbers
                 $pageNumbers = '<div class="numbers">'.$pagination->getLinks($_GET).'</div>';
                  // Loop through all the items in the array
                  echo "<div id=\"imagePaginationNavigation\">".$pageNumbers."</div>";
                 
                  foreach ($messagePages as $imageArray) {
                    // Show the information about the item
        
                        echo "<div class=\"uploadImageDiv\">";
                        echo "File name: ". $imageArray["name"]."</br></br>";
                        echo "<img class=\"uploadImage\" src=\"uploads\\".$user_name."\\prew_".$imageArray["name"]."\" >";
                        echo "</br></br>";
                        echo "File size: ".round($imageArray["size"], 2)." Mb</br>";
                        echo "<a class=\"uploadedImageBtn\" href=\"uploads\\".$user_name."\\".$imageArray["name"]."\">Full preview</a>";
                        echo "<a class=\"uploadedImageBtn\" href=\"user_account.php?img_id_delete=".$imageArray["id"]."&img_name=".$imageArray["name"]."\">Delete</a>";
                        echo "</div>";
                       
                  } 
                  // print out the page numbers beneath the results
                //   echo "</br>";
                //   echo "<hr>";
                //   echo "</br>";
                //   echo $pageNumbers;
                }
            }
   
}

function deleteAccount($userId){
    $sql = "DELETE FROM useri WHERE id=$userId";
    global $connection;

    if($connection->query($sql) === TRUE){
        header("Location: login.php");
    }    
}

function deleteUploadedImage($id, $user_name, $img_name){
    $sql = "DELETE FROM images_upload WHERE id=$id";
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

        header("Location: user_account.php");
    }

}

?>
