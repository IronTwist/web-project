<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/connection/config.php";

$userId = htmlspecialchars($_GET["user_id"]);
$userName = htmlspecialchars($_GET["user"]);

$target_dir = "../uploads/".$userName."/";
$file_upload_name = basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $file_upload_name;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"]) && !empty($_FILES["fileToUpload"]["name"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "</br>File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "</br>File is not an image.";
    $uploadOk = 0;
  }
}else{
    echo "<p>No file has been selected!</p>";
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "</br>Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 40000000) {
  echo "</br>Sorry, your file is too large. (max 38 MB)";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "</br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}


//My function to transform original image in a smaller one
function create_prew_file($file, $max_resolution, $imageFileType, $target_dir, $file_upload_name){
  
  //for jpg
  if(file_exists($file) && $imageFileType == "jpg" || $imageFileType == "jpeg"){
    $original_image = imagecreatefromjpeg($file);

    //Original image resolution
    $orig_width = imagesx($original_image);
    $orig_height = imagesy($original_image);

    $r= $max_resolution / $orig_width;
    $new_width = $max_resolution;

    $new_height = $orig_height * $r;

    if($original_image){
      $new_image = imagecreatetruecolor($new_width, $new_height);
      imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width,$new_height, $orig_width, $orig_height);

      $path = $target_dir . "prew_".$file_upload_name;

      imagejpeg($new_image, $path, 85);
    }
  }

  //For PNG files save prew
  if(file_exists($file) && $imageFileType == "png"){
    echo $file;
    $original_image = imagecreatefrompng($file);

    //Original image resolution
    $orig_width = imagesx($original_image);
    $orig_height = imagesy($original_image);

    $r= $max_resolution / $orig_width;
    $new_width = $max_resolution;

    $new_height = $orig_height * $r;


    //reduce pic size
    if($new_height > $max_resolution){
      $r = $$max_resolution / $$orig_height;
      $new_height = $$max_resolution;
      $new_width = $$orig_width * $r;
    }

    if($original_image){
      $new_image = imagecreatetruecolor($new_width, $new_height);
      imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width,$new_height, $orig_width, $orig_height);

      $path = $target_dir . "prew_".$file_upload_name;

      imagepng($new_image, $path, 9);
    }
  }

  //for GIF save prew
  if(file_exists($file) && $imageFileType == "gif"){
    echo $file;
    $original_image = imagecreatefromgif($file);

    //Original image resolution
    $orig_width = imagesx($original_image);
    $orig_height = imagesy($original_image);

    $r= $max_resolution / $orig_width;
    $new_width = $max_resolution;

    $new_height = $orig_height * $r;


    //reduce size
    if($new_height > $max_resolution){
      $r = $$max_resolution / $$orig_height;
      $new_height = $$max_resolution;
      $new_width = $$orig_width * $r;
    }

    if($original_image){
      $new_image = imagecreatetruecolor($new_width, $new_height);
      imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width,$new_height, $orig_width, $orig_height);

      $path = $target_dir . "prew_".$file_upload_name;

      imagegif($new_image, $path);
    }
  }

}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "</br>Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $sql = "INSERT INTO images_upload(user_id, name, size) VALUES ('$userId','".$_FILES["fileToUpload"]["name"]."','".$_FILES["fileToUpload"]["size"] / 1000000 ."')";
    $connection->query($sql);
    echo "</br>The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

    create_prew_file($target_file,"1200", $imageFileType, $target_dir, $file_upload_name);

  } else {
    echo "</br>Sorry, there was an error uploading your file.";
  }
}

?>

<pre>
    <img src="../uploads/<?php echo $userName."/".$_FILES["fileToUpload"]["name"] ?>" alt="file uploaded preview" width="400px" height="280px">
    <?php 
    $_FILES["fileToUpload"]["Data"] = new DateTime("now");
    print_r("File size: ".$_FILES["fileToUpload"]["size"] / 1000000 ." Mb");
     ?>
</pre>
<input id="ok" type="submit" onclick="history.back()" value="OK">
