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

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setHashedPassword($password) {
        $this->hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }
    
    public function getHashedPassword() {
        return $this->hashedPassword;
    }

    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {
            //$sql = "INSERT INTO Users (email,username,hashed_password) VALUES "
              //      . "('$this->email','$this->username','$this->hashedPassword')";
            //$result = $connection->query($sql);
            //if ($result == true) {
              //  $this->id = $connection->insert_id;
               // return true;
            $sql = "INSERT INTO Users (email,username,hashed_password) VALUES "
                    . "(?,?,?)";
            $result = $connection->prepare($sql);
            $result->bind_param("sss", $this->email, $this->username, $this->hashedPassword);
            $result->execute();
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        } else {
            //$sql = "UPDATE Users SET email = '$this->email', username = '$this->username',"
            //        . " hashed_password = '$this->hashedPassword'"
            //        . "WHERE id = $this->id";
            //$result = $connection->query($sql);
            //if ($result == true) {
            //    return true;
            $sql = "UPDATE Users SET email = ?, username = ?,"
                    . " hashed_password = ? "
                    . "WHERE id = ?";
            $result = $connection->prepare($sql);
            $result->bind_param("ssss", $this->email, $this->username, $this->hashedPassword, $this->id);
            $result->execute();
            if ($result == true) {
                return true;
            }
        }
        return false;
    }

    public function delete (mysqli $connection) {
        if ($this->id != -1) {
            $sql = "DELETE FROM Users WHERE id = $this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = -1;
                return true;
            } else {
                return false;
            }
        }
        return true;
    }
    
    public function login() {
        $_SESSION['user_id'] = $this->id;
    }
    public function logout() {
        unset($_SESSION['user_id']);
    }
                    
    static public function loadUserByID(mysqli $connection, $id) {
        $sql = "SELECT * FROM Users WHERE id = $id";
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->email = $row['email'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashedPassword = $row['hashed_password'];

            return $loadedUser;
        }
        return null;
    }

    static public function loadAllUsers(mysqli $connection) {
        $sql = "SELECT * FROM Users";
        $ret = array();
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows > 0) {
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
    
    static public function loadUserByEmail(mysqli $connection, $email) {
        $sql = "SELECT * FROM Users WHERE email = '$email'";
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->email = $row['email'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            return $loadedUser;
        }
        return FALSE;
    }
    
}
