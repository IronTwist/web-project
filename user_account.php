<?php
    require_once "../MyWebsite/includes/header.php";
    include "includes/navigation.php";
    require_once "../MyWebsite/includes/user_account_functions.php";

    if(!isset($_SESSION["user_id"])){
        header("Location: login.php");
    }

    $user_id =  $_SESSION["user_id"];
    $user = $_SESSION["user"];
    makeDirForUpload($user);

?>

<h3 id="manageAcc">Manage account for username: </h3>
<span class="deleteAccountBtn" id="deleteAccountBtn">
    <form method="GET">
        <input type="hidden" value="<?php echo $user_id; ?>" name="user_id">
        <input type="submit" id="deleteAccount" name="delete" value="Delete Account">
    </form>
</span>
</br>
<div class="userAccountDataUpdate">
<form action="user_account.php" method="POST" enctype="multipart/form-data">
<span>Name:</span>     
<input type="text" name="name" value="<?php 
    if(isset($_SESSION["name"])){
        echo $_SESSION["name"];
    }
?>">
</br></br>
<span>Surname:</span>     
<input type="text" name="surname" value="<?php 
    if(isset($_SESSION["surname"])){
        echo $_SESSION["surname"];
    }
?>">
</br></br>
<input type="submit" id="submit" name="submit" value="UPDATE">
</form>
</div>

</br>
<div>
    <h2>Select Logo</h2>
    <select class="selectLogo" name="myPicList">
        <option disabled hidden selected>Select picture</option>
    <?php 
        $sql = mysqli_query($connection, "SELECT * FROM images_upload WHERE user_id=$user_id");
        while ($row = $sql->fetch_assoc()){
        echo "<option value=\"".$row['name']."\">" . $row['name'] . "</option>";
    }
    ?>
    </select>
</div>
</br>
<h2>Photo Album</h2>
<div class="userAccountDataUpload">
    <form action="/MyWebsite/includes/upload.php?user=<?php echo $user; ?>&user_id=<?php echo $user_id; ?>" method="post" enctype="multipart/form-data">
        <input  type="file" name="fileToUpload" id="fileToUpload" accept=".gif, .png, .jpg, .jpeg">
        
        <input class="add" type="submit" value="Upload" name="submit">
    </form> 
    
</div>

<div class="showPicturesDiv">
<?php
// showUploadedImages($user, $user_id, $connection); //display without pagination

    $array_images_from_user = get_all_images_for_user("images_upload", $connection, $user_id);
	$array_images_from_user = array_reverse($array_images_from_user);

	showUploadedImages($array_images_from_user, $user_id, 6, $user);

?>
</div>

<div id="pageNavigation" class="pageNavigation">

</div>

<?php
    require_once "includes/footer.php";
?>

<script type="text/javascript">
    var title = document.getElementById("manageAcc").innerText;
    title = title + " <?php echo $_SESSION["user"];  ?>";
    var titleUpdate = title
    title = document.getElementById("manageAcc").innerHTML = titleUpdate;
    
    document.getElementById("submit").onclick = function confirmare(){
        if(confirm('Are you sure you want to Update?')){
            return true;
        }else{
            location.reload();
            return false;   
        }
    }

    document.getElementById("deleteAccount").onclick = function confirmDelete(){
        if(confirm('Are you sure you want to Delete your account?')){
            return true;
        }else{
            location.reload();
            return false;   
        }
    }
    
    let selection = document.querySelector('select');
    let result = document.getElementById("headerLogo");
   
    selection.addEventListener('change', ()=>{

        var value = selection.options[selection.selectedIndex].text;
        var userName = "<?php echo $_SESSION["user"];  ?>";
        
        console.log(value);
        console.log(userName);

        result.style.backgroundImage = "url('uploads/"+ userName +"/prew_"+ value +"')";


        //save in localstorage
        localStorage['logoSave'] = "url('uploads/"+ userName +"/prew_"+ value +"')";
        localStorage['user_id'] = "<?php echo $_SESSION["user_id"];  ?>";

    });

    var userId = <?php echo $_SESSION["user_id"] ?>

    if(localStorage['logoSave'] && localStorage['user_id'] == userId){
        result.style.backgroundImage = localStorage['logoSave'];
    }

    $("#imagePaginationNavigation").appendTo("#pageNavigation");
    
</script>


