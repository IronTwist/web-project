<?php



function showMessages($array, $user_id){
    for($i=0; $i < count($array); $i++){

	//	if($array[$i]['id_user'] === $user_id){
			echo $array[$i]['id']." ".$array[$i]['id_user']." : ". $array[$i]['mesaj']."</br>";
	//	}
	}
}

function paginationMessages($array, $user_id, $show_per_page){
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
          foreach ($messagePages as $messageArray) {
            // Show the information about the item

                $postDateTime = $messageArray["data"];

                echo "</br>";

                echo "<div class=\"message\">";
                echo "<h2>".$messageArray["titlu"]."</h2>";
                echo "<hr>";
                echo "<a onclick=\"return confirm('Are you sure you want to delete this post?')\" 
                href=\"action_page.php?clickDelete=".$messageArray["id"]."\" id=\"btnDelete\" 
                class=\"btnDelete\">&#x2715</a>";
                echo '<p class="showMessage">'.$messageArray['mesaj'].'</p>';
                echo "<hr>";
                echo "A fost postat acum: ".getHowMuchTimePassed($postDateTime)."</br>";
                
                echo "</div>";
               
          } 
          // print out the page numbers beneath the results
          echo "</br>";
          echo $pageNumbers;
        }
    }
}

function insert_into_mesaje($id_user, $titlu, $message, $connection){
    $sql = "INSERT INTO mesaje(id_user, titlu, mesaj) VALUES ('".$id_user."','".$titlu."','".$message."')";

    if($connection->query($sql) === TRUE){
        echo "<p>Postarea a fost adaugata cu succes!</p>";
        header("Location: action_page.php");
    }else{
        echo "<p class=\"redMessage\">Nu am reusit sa adaug mesajul in baza de date</p";
    }
}

function insert_into_useri($user_name, $password, $name, $connection){
    $sql = "INSERT INTO useri(userName, password, name) VALUES ('".$user_name."','".$password."','".$name."')";

    if($connection->query($sql) === TRUE){
        echo "User adaugat cu succes";
    }else{
        echo "Eroare la adaugarea user-ului";
    }
}

function get_all_mesages_for_user($table, $connection, $user_id){
    $sql = "SELECT * FROM $table WHERE id_user='".$user_id."'";
    $result = $connection->query($sql);

    $array = array();

			$index = 0;
			while($row = $result->fetch_assoc()){
				$array[$index] = $row;
				$index++;
			}

    return $array;
}

function get_all_images_for_user($table, $connection, $user_id){
    $sql = "SELECT * FROM $table WHERE user_id='".$user_id."'";
    $result = $connection->query($sql);

    $array = array();

			$index = 0;
			while($row = $result->fetch_assoc()){
				$array[$index] = $row;
				$index++;
			}

    return $array;
}

if(isset($_GET['clickDelete'])){
    delete_message($connection, $_GET["clickDelete"]);
    unset($_GET['clickDelete']);
}

function delete_message($connection, $id){
    
    $sql = "DELETE FROM mesaje WHERE id='".$id."'";

    if($connection->query($sql) === TRUE){
        header("Location: ../mywebsite/index.php");
    }else{
        echo "Mesajul nu exista, poate ca a fost sters.";
    }
}

//Function to calculate time
// function dateTimeDiferenceFunction($postDateTime){
//     $split = str_split($postDateTime);

//                 $anul = $split[0].$split[1].$split[2].$split[3];
//                 $luna = $split[5].$split[6];
//                 $ziua = $split[8].$split[9];
//                 $ora = $split[11].$split[12];
//                 $min = $split[14].$split[15];
//                 $sec = $split[17].$split[18];

//                 // print_r($split);

//                 echo $anul." ".$luna." ".$ziua." ".$ora." ".$min." ".$sec;

//                 echo "</br>";
//                 $nowDateTime =new DateTime("now");
//                 $currentDateTime = $nowDateTime->format('Y-m-d H:i:s');

//                 $splitCurrent = str_split($currentDateTime);

//                 $anulCurrent = $splitCurrent[0].$splitCurrent[1].$splitCurrent[2].$splitCurrent[3];
//                 $lunaCurrent = $splitCurrent[5].$splitCurrent[6];
//                 $ziuaCurrent = $splitCurrent[8].$splitCurrent[9];
//                 $oraCurrent = $splitCurrent[11].$splitCurrent[12]; //+ 1 ora
//                 $minCurrent = $splitCurrent[14].$splitCurrent[15];
//                 $secCurrent = $splitCurrent[17].$splitCurrent[18];

//                 // print_r($currentDateTime);

//                 echo $anulCurrent." ".$lunaCurrent." ".$ziuaCurrent." ".$oraCurrent." ".$minCurrent." ".$secCurrent;
// }

function currentYearString(){
    $nowDateTime =new DateTime("now");
                $currentDateTime = $nowDateTime->format('Y-m-d H:i:s');

                $splitCurrent = str_split($currentDateTime);

                $anulCurrent = $splitCurrent[0].$splitCurrent[1].$splitCurrent[2].$splitCurrent[3];
                $lunaCurrent = $splitCurrent[5].$splitCurrent[6];
                $ziuaCurrent = $splitCurrent[8].$splitCurrent[9];
                $oraCurrent = $splitCurrent[11].$splitCurrent[12]; 
                $oraCurrent = $oraCurrent + 1;//+ 1 ora
                $minCurrent = $splitCurrent[14].$splitCurrent[15];
                $secCurrent = $splitCurrent[17].$splitCurrent[18];

                // print_r($currentDateTime);

                return $anulCurrent."-".$lunaCurrent."-".$ziuaCurrent." ".$oraCurrent.":".$minCurrent.":".$secCurrent;
}

function getHowMuchTimePassed($postDateTime){
    $strStart = $postDateTime;
    $strEnd   = currentYearString(); 
    
    $dteStart = new DateTime($strStart);
    $dteEnd   = new DateTime($strEnd); 

    $dteDiff  = $dteStart->diff($dteEnd); 

    return $dteDiff->format("%Y ani %M luni %D zile - %H ore %I minute %S secunde");
}

function makeDirForUpload($user){
    $userPathString = "uploads/".$user."/";
    if(!file_exists($userPathString)){
        mkdir($userPathString);
    }
}

function removeDirForUpload($user){
    $userPathString = "uploads/".$user."/";
    if(!file_exists($userPathString)){
        rmdir($userPathString);
    }
}

?>