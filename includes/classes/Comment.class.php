<?php

class Comment{
    private $id, $postId, $userId, $comment, $datetime;

    public function __construct($postId, $userId, $comment)
    {
        $this->postId = $postId;
        $this->userId = $userId;
        $this->comment = $comment;
    }

    public static function deleteCommentCtr($id){
        $instance = new self(0,0,"");
        $result = $instance->deleteComment($id);
        return $result;
    }

    function deleteComment($id){
        global $connection;

        $sql = "DELETE FROM comments WHERE id='$id'";

        $result = $connection->query($sql);

        if($result == TRUE){
            return TRUE;
        }

        return FALSE;
    }

    function addComment(){
        global $connection;
        $comment = addslashes($this->comment);
        $sql = "INSERT INTO comments(post_id, user_id, comment) VALUES('$this->postId', '$this->userId', '$comment')";
        
        $result = $connection->query($sql);
    
        if($result){
            return TRUE;
        }
    
        return FALSE;
    }

    function getAllCommentsForPost(){
        global $connection;
        $comments = [];

        $sql = "SELECT * FROM comments WHERE post_id=$this->postId";
        $result = $connection->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $comment = new Comment($row["post_id"], $row["user_id"], $row["comment"]);
                $comment->setDatetime($row["datetime"]);
                $comment->setId($row["id"]);    

                array_push($comments, $comment);
            }
        }

        return $comments;
    }

    /**
     * Get the value of postId
     */ 
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set the value of postId
     *
     * @return  self
     */ 
    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {   
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of datetime
     */ 
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set the value of datetime
     *
     * @return  self
     */ 
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}

?>