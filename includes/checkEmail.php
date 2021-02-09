<?php

if(isset($_GET["email"])){
	include  $_SERVER['DOCUMENT_ROOT']."/connection/config.php";
	$ok= 1;

	$email=htmlentities($_GET["email"]);

	$query="SELECT * FROM users WHERE email='$email'";

	$result=$connection->query($query);
		if ($result->num_rows > 0){
			$ok= 0;
		}
		
	echo $ok;
}