<?php
require_once $_SERVER['DOCUMENT_ROOT']."/connection/config.php";
require_once "functions.php";
require_once "./classes/Comment.class.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["submitComment"])) {

        $postId = filterInput($_POST["postId"]);
        $userId = filterInput($_POST["userId"]);
        $comment = filterInput($_POST["comment"]);

        if (!empty($comment)) {

            $comment = new Comment($postId, $userId, $comment);

            $result = $comment->addComment();

            if ($result == true) {
                echo "Mesaj adaugat cu succes!";
                header("Location: ../post.php?viewPost=$postId");
            } else {
                echo "Erroare adaugare mesaj";
            }
        }else{
            header("Location: ../post.php?viewPost=$postId");
        }   
    }

}

?>