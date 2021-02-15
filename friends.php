<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."../includes/header.php";
require_once $root."../connection/config.php";

if(isset($_GET["accept"]) && isset($_GET["userId"])){
    $accept = filter_var($_GET["accept"]);
    $userIdFriend = filter_var($_GET["userId"]);

    if($accept == true){
        acceptUserFriendship($userIdFriend, $_SESSION["user"]->getUser_id());
    }
}

?>
<div style="width:100%; height: 120px">
    <h1>Friends page</h1>
    <div>
        <h4>Friends request</h4>
        <div>
            <?php
            //TODO receive request show
            $requests = getRequestsReceived($_SESSION["user"]->getUser_id()); // get id's of friend request
            
            if(!empty($requests)){

                foreach($requests as $request){     //request is id of the user

                    $sql = "SELECT * FROM users WHERE id=$request";

                    $result = $connection->query($sql);        // query data of the user to know what user sent the request
                    
                    if($result->num_rows > 0){
                         $row = $result->fetch_assoc();
                         echo $row["userName"]." sent you a friend request:</br> ";
                         echo "<a href=\"friends.php?accept=true&userId=".$request."\">Accept</a> / ";
                         echo "<a href=\"friends.php?accept=false&userId=".$request."\">Remove</a></br>";
                    }
                }
            }

            ?>
        </div>
    </div>
</div></br></br></br>
<?php
require_once $root."/includes/footer.php";
?>