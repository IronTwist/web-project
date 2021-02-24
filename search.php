<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."../includes/header.php";

if(isset($_SESSION["user"])){
    $userName = $_SESSION["user"];
}

if(isset($_GET["stringToSearch"])){
    $findString = $_GET["stringToSearch"];
}

?>

<div>
<?php
    if (isset($_SESSION["user"])) {
        $postsFound = searchPosts($findString);

        if (!empty($postsFound)) {
            searchPaginationPosts($postsFound, 6, "", $findString);
        } else {
            echo "<p>No result found for: ".$findString."</p>";
        }
    }else{
        header("Location: login.php");
    }
?>
</div>

<?php
require_once $root."/includes/footer.php";
?>