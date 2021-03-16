<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."../includes/header.php";
if(isset($_SESSION)){
    $userName = $_SESSION["user"]->getUserName();
    $userId = $_SESSION["user"]->getUser_Id();
}

if(isset($_GET["img_id_delete"])){
    $img_id = $_GET["img_id_delete"];
    $img_name = $_GET["img_name"];

    deleteUploadedImage($img_id, $userName, $img_name);
    header('Location: photos.php');
}

if(isset($_GET["profile_set_img"])){
    $img_name = $_GET["profile_set_img"];
    $userId = $_SESSION["user"]->getUser_Id();

    setImageAsProfilePhoto($userId, $img_name);
    header('Location: photos.php');
}

?>
</br>
<div class="userAccountDataUpload">
    <form action="/includes/upload.php?user=<?php echo $userName; ?>&user_id=<?php echo $userId; ?>" method="post" enctype="multipart/form-data">
        <input  type="file" name="fileToUpload" id="fileToUpload" accept=".gif, .png, .jpg, .jpeg">
        <input class="add" type="submit" value="Upload" name="submit">
    </form> 
    
</div>
<div class="photosPage">
<?php
showUploadedImages($userName, $userId);
?>
</div>

<?php
require_once $root."/includes/footer.php";
?>