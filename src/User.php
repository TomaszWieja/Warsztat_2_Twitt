<?php

class User {
    private $id;
    private $email;
    private $username;
    private $hashedPassword;
    
    public function __construct() {
        $this->id = -1;
        $this->email = "";
        $this->username = "";
        $this->hashedPassword = "";
    }
    
    public function getId() {
        return $this->id;
    }
    
    function getEmail() {
        return $this->email;
    }

    function getUsername() {
        return $this->username;
    }

    function getHashedPassword() {
        return $this->hashedPassword;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setHashedPassword($password) {
        $this->hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }
    
    public function saveToDB( mysqli $connection) {
        var_dump($this);
        if ($this->id == -1) {
            $sql = "INSERT INTO Users (email, username, hashed_password) VALUES"
                    . "('$this->email', '$this->username', '$this->hashedPassword')";
            $result = $connection->query($sql);
            if ($result == TRUE) {
                $this->id = $connection->insert_id;
                return TRUE;
            }
        } else {
                $sql = "UPDATE Users SET email = '$this->email', username = '$this->username',"
                        . " hashed_password = '$this->hashedPassword' WHERE id = $this->id";
                $result = $connection->query($sql);
                var_dump($result);
                if ($result == TRUE) {
                    return TRUE;
                }
        }
        
        return false;
    }
    
    public function delete(mysqli $connection) {
        if ($this->id != -1) {
            $sql = "DELETE FROM Users WHERE id = $this->id";
            $result = $connection->query($sql);
            if ($result == TRUE) {
             $this->id = -1;
             return TRUE;
            }
            return FALSE;
        }
        return TRUE;
    }




    
    
    static public function loadUserById(mysqli $connection, $id) {
        $sql = "SELECT * FROM Users WHERE id = $id";
        $result = $connection->query($sql);
        if ($result == TRUE && $result->num_rows == 1) { //num_rows zwraca ile rzędów zawiera wynik
            $row = $result->fetch_assoc();
            
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->email = $row['email'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            
            return $loadedUser;
        }
        return NULL;
    }
    
    static public function loadAllUsers(mysqli $connection) {
        $sql = "SELECT * FROM Users";
        $ret = array();
        $result = $connection->query($sql);
        if ($result == TRUE && $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->email = $row['email'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashedPassword = $row['hashed_password'];
                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }
    

}



