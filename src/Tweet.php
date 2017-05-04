<?php

class Tweet {
    
    private $id;
    private $userId;
    private $text;
    private $creationDate;
    
    public function __construct() {
        $this->id = -1;
        $this->userId = 0;
        $this->text = "";
        $this->creationDate = NULL;
    }
    
    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    function getId() {
        return $this->id;
    }

    function getUserId() {
        return $this->userId;
    }

    function getText() {
        return $this->text;
    }

    function getCreationDate() {
        return $this->creationDate;
    }

    static public function loadTweetById(mysqli $connection, $id) {
        $sql = "SELECT * FROM Tweets WHERE id = $id";
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            $loadedTweet = new Tweet();
            $loadedTweet->id = $row['id'];
            $loadedTweet->userId = $row['userId'];
            $loadedTweet->text = $row['text'];
            $loadedTweet->creationDate = $row['creationDate'];
            
            return $loadedTweet;
        }
        return NULL;
    }
    
    static public function loadAllTweetsByUserId(mysqli $connection, $userId) {
        $sql = "SELECT * FROM Tweets WHERE userId = $userId";
        $result = $connection->query($sql);
        $ret = array();
        if ($result == TRUE && $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['userId'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creationDate'];
                $ret[] = $loadedTweet;
             }
        }
        return $ret;
    }
    
    static public function loadAllTweets(mysqli $connection) {
        $sql = "SELECT * FROM Tweets ORDER BY creationDate DESC";
        $result = $connection->query($sql);
        $ret = array();
        if ($result == TRUE && $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['userId'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creationDate'];
                $ret[] = $loadedTweet;
            }
        }
        return $ret;
    }
    
    public function saveToDB(mysqli $connection) {
        
        $sql = "INSERT INTO Tweets(userId, text, creationDate) VALUES($this->userId, '$this->text', '$this->creationDate')";
        $result = $connection->query($sql);
        if ($result == TRUE) {
            $this->id = $connection->insert_id;
            return TRUE;
        }
        
    }
}

