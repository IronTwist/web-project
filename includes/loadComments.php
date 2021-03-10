<?php

if(isset($_GET["postId"])){
	include  $_SERVER['DOCUMENT_ROOT']."/connection/config.php";
	$array = [];

	$postId=htmlentities($_GET["postId"]);

	$query="SELECT comments.id, comments.post_id, comments.user_id, comments.comment, comments.datetime, users.userName   
	FROM comments 
	INNER JOIN users          
	ON comments.user_id = users.id 
	WHERE post_id='$postId'";
   
	$result=$connection->query($query);
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
                array_push($array, $row);
            }
		}
		
    $response = $array;
    echo json_encode($response); 
}

?>
