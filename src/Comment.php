<?php

class Comment {
    
    private $id;
    private $userId;
    private $postId;
    private $creationDate;
    private $text;
    
    public function __construct() {
        $this->id = -1;
        $this->userId = 0;
        $this->postId = 0;
        $this->creationDate = NULL;
        $this->text = "";
    }
    
    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setPostId($postId) {
        $this->postId = $postId;
    }

    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    function setText($text) {
        $this->text = $text;
    }

    function getId() {
        return $this->id;
    }

    function getUserId() {
        return $this->userId;
    }

    function getPostId() {
        return $this->postId;
    }

    function getCreationDate() {
        return $this->creationDate;
    }

    function getText() {
        return $this->text;
    }

    static public function loadCommentById(mysqli $connection, $id) {
        $sql = "SELECT * FROM ORDER BY creationDate Comments WHERE id = $id";
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            $loadedComment = new Comment();
            $loadedComment->id = $row['id'];
            $loadedComment->userId = $row['userId'];
            $loadedComment->postId = $row['postId'];
            $loadedComment->creationDate = $row['creationDate'];
            $loadedComment->text = $row['text'];
            
            return $loadedComment;
        }
        return NULL;
    }
    
    static public function loadAllCommentsByPostId(mysqli $connection, $postId) {
        $sql = "SELECT * FROM Comments WHERE postId = $postId";
        $result = $connection->query($sql);
        $ret = array();
        if ($result == TRUE && $result->num_rows > 0) {
            foreach ($result as $row) {
                
                $loadedComment = new Comment();
                $loadedComment->id = $row['id'];
                $loadedComment->userId = $row['userId'];
                $loadedComment->postId = $row['postId'];
                $loadedComment->creationDate = $row['creationDate'];
                $loadedComment->text = $row['text'];
                $ret[] = $loadedComment;
            }
        }
        return $ret;
    }
    
    public function saveToDB(mysqli $connection) {
        $sql = "INSERT INTO Comments(userId, postId, creationDate, text) VALUES($this->userId, $this->postId, '$this->creationDate', '$this->text')";
        $result = $connection->query($sql);
        if ($result == TRUE) {
            $this->id = $connection->insert_id;
            return TRUE;
        }
    }
}
