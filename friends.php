<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."../includes/header.php";
require_once $root."../connection/config.php";

/**
 * TODO fix duplicate send, sa verifica cine a trimis prima data cerere de prietenie
 */


if(isset($_GET["accept"]) && isset($_GET["userId"])){
    $accept = $_GET["accept"];
    $userIdFriend = filter_var($_GET["userId"], FILTER_VALIDATE_INT);

    if($accept == true){
        acceptUserFriendship($userIdFriend, $_SESSION["user"]->getUser_id(), "ACCEPT");
    }
    
    if($accept == false){
        acceptUserFriendship($userIdFriend, $_SESSION["user"]->getUser_id(), "REMOVE");
    }
}

if(isset($_GET["removeUserId"])){
    $userIdToRemove = filter_var($_GET["removeUserId"], FILTER_VALIDATE_INT);
    if($userIdToRemove == true){
        removeFriend($_SESSION["user"]->getUser_id(), $userIdToRemove);
    }else{
        header("Location: friends.php");
    }
}

?>
<div style="width:100%; height: 120px">
    <h1>Friends page</h1>
    <div>
        <h4>Friends request</h4>
        <div>
            <?php
           
            $requests = getRequestsReceived($_SESSION["user"]->getUser_id()); // get id's of friend request
            
            if(!empty($requests)){

                foreach($requests as $request){     //request is id of the user
                    $idSender = $request['user_id_sender']; //of sender
                    $data = $request["data"]; //data was sent

                    $sql = "SELECT * FROM users WHERE id=$idSender";

                    $result = $connection->query($sql);        // query data of the user to know what user sent the request
                    
                    if($result->num_rows > 0){
                         $row = $result->fetch_assoc();
                         echo $data." ";
                         echo $row["userName"]." sent you a friend request:</br> ";
                         echo "<a href=\"friends.php?accept=true&userId=".$idSender."\">Accept</a> / ";
                         echo "<a href=\"friends.php?accept=false&userId=".$idSender."\">Remove</a></br>";
                    }
                }
            }

            ?>
        </div>
    </div>
</div></br></br></br>

<h4>My Friends</h4>
<div class="showUsersOnFrindsPage">
        <?php
        if (isset($_SESSION["user"])) {
            $users = getAllUsers();

            foreach ($users as $user) {
                if ($user->getUser_id() != $_SESSION["user"]->getUser_id()) { //other users 
                    
                    $frindsId = getAllFriendships($_SESSION["user"]->getUser_id()); //get all my friends id's

                    foreach ($frindsId as $friendId) {

                        if ($user->getUser_id() == $friendId) { //show if is a friend
                   ?>
                    <div class="showUserFriend" style="background-image: <?php echo userProfilePic($user->getUser_id(), $user->getUserName()); ?>;">
                    <div><?php echo $user->getUserName(); ?></div></br>
                    
                    <a class="removeFriend" href="friends.php?removeUserId=<?php echo $user->getUser_id(); ?>">Remove Friend</a>
                        
                    </div>  
                 <?php
                        }
                    } 
                    ?> 
                 
                 <?php  
                }// end if
            } //end foreach $users
        }else{
            header("Location: login.php");
        }
        ?>
    </div>
<?php
require_once $root."/includes/footer.php";
?>