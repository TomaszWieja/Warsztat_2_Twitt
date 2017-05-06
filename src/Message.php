<?php

class Message {
    
    private $id;
    private $senderId;
    private $receiverId;
    private $text;
    private $creationDate;
    private $see;
    
    public function __construct() {
        $this->id = -1;
        $this->senderId = 0;
        $this->receiverId = 0;
        $this->text = "";
        $this->creationDate = "";
        $this->see = NULL;
    }
    
    function setSenderId($senderId) {
        $this->senderId = $senderId;
    }

    function setReceiverId($receiverId) {
        $this->receiverId = $receiverId;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    function setSee($see) {
        $this->see = $see;
    }

    function getId() {
        return $this->id;
    }

    function getSenderId() {
        return $this->senderId;
    }

    function getReceiverId() {
        return $this->receiverId;
    }

    function getText() {
        return $this->text;
    }

    function getCreationDate() {
        return $this->creationDate;
    }

    function getSee() {
        return $this->see;
    }

    static public function loadMessagesBySenderId(mysqli $connection, $senderId) {
        $sql = "SELECT * FROM Messages WHERE senderId = $senderId ORDER BY creationDate DESC";
        $result = $connection->query($sql);
        $ret = array();
        if ($result == TRUE && $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadedMessage = new Message();
                $loadedMessage->id = $row['id'];
                $loadedMessage->senderId = $row['senderId'];
                $loadedMessage->receiverId = $row['receiverId'];
                $loadedMessage->text = $row['text'];
                $loadedMessage->creationDate = $row['creationDate'];
                $loadedMessage->see = $row['see'];
                $ret[] = $loadedMessage;
            }
        }
        return $ret;
    }
    
    static public function loadMessagesByReceiverId(mysqli $connection, $receiverId) {
        $sql = "SELECT * FROM Messages WHERE receiverId = $receiverId ORDER BY creationDate DESC";
        $result = $connection->query($sql);
        $ret = array();
        if ($result == TRUE && $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadedMessage = new Message();
                $loadedMessage->id = $row['id'];
                $loadedMessage->senderId = $row['senderId'];
                $loadedMessage->receiverId = $row['receiverId'];
                $loadedMessage->text = $row['text'];
                $loadedMessage->creationDate = $row['creationDate'];
                $loadedMessage->see = $row['see'];
                $ret[] = $loadedMessage;
            }
        }
        return $ret;
    }
    
    static public function loadMessagesById(mysqli $connection, $id) {
        $sql = "SELECT * FROM Messages WHERE id = $id";
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $loadedMessage = new Message();
            $loadedMessage->id = $row['id'];
            $loadedMessage->senderId = $row['senderId'];
            $loadedMessage->receiverId = $row['receiverId'];
            $loadedMessage->text = $row['text'];
            $loadedMessage->creationDate = $row['creationDate'];
            $loadedMessage->see = $row['see'];
            
            return $loadedMessage;
        }
        return NULL;
    }
    
    public function saveToDB(mysqli $connection) {
        //$sql = "INSERT INTO Messages(senderId, receiverId, text, creationDate) VALUES($this->senderId, $this->receiverId, '$this->text', '$this->creationDate')";
        //$result = $connection->query($sql);
        //if ($result == TRUE) {
        //    $this->id = $connection->insert_id;
        //    return TRUE;
        //}
        $sql = "INSERT INTO Messages(senderId, receiverId, text, creationDate) VALUES(?, ?, ?, ?)";
        $result = $connection->prepare($sql);
        $result->bind_param("ssss", $this->senderId, $this->receiverId, $this->text, $this->creationDate);
        $result->execute();
        if ($result == true) {
            return true;
        }
        return FALSE;
    }
    
    public function setSeeById(mysqli $connection, $id) {
        //$sql = "UPDATE Messages SET see = 1 WHERE id = $id";
        //$result = $connection->query($sql);
        //if ($result == TRUE) {
        //    return TRUE;
        //}
        $sql = "UPDATE Messages SET see = 1 WHERE id = ?";
        $result = $connection->prepare($sql);
        $result->bind_param("s", $id);
        $result->execute();
        if ($result == true) {
            return true;
        }
        return FALSE;
    }
}

