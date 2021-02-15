<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."../includes/header.php";
require_once $root."../includes/functions.php";


?>
<h1>Home Place</h1>


<div>
    <h4>MyPlace users</h4>
    <div class="showUsersOnHome">
        <?php
        if (isset($_SESSION["user"])) {
            $users = getAllUsers();

            foreach ($users as $user) {
                if ($user->getUser_id() != $_SESSION["user"]->getUser_id()) {
                    ?>
            <div class="showUser" style="background-image: <?php echo userProfilePic($user->getUser_id(), $user->getUserName()); ?>;">
                <div><?php echo $user->getUserName(); ?></div></br>
                <?php
                    $friendship = getAllFriendships();
                    foreach($friendship as $friend){
                        // print_r($friend);
                        // if($friend["request_approved"] == 0 && $user->getUser_id() == $friend["friend"]){}
                    }
                ?>
                <a class="sendFriendReqLink" href="includes/sendFriendRequest.php?userId=<?php echo $user->getUser_id(); ?>">Add Friend</a>
            </div>    

            <?php
                }//end if
            } //end foreach
        }else{
            header("Location: login.php");
        }
        ?>
    </div>
</div>
<?php
require_once $root."/includes/footer.php";
?>