<?php

require_once "DBInit.php";

class UserDB {

    public static function validLoginAttempt($username, $password) {

        $dbh = DBInit::getInstance();

        $query = "SELECT COUNT(id) FROM users WHERE username = :username AND password = :password";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        $user = $stmt->fetch();
        if($user != null) return 1;
        else return 0;
    }

    public static function checkIfUserIsAdmin($username){

        $dbh = DBInit::getInstance();

        $query = "SELECT id FROM users WHERE username = :username AND administrator = 1";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $user = $stmt->fetch();
        if($user != null) return 1;
        else return 0;
    
    }

    public static function getIdByUsername($username){

        $dbh = DBInit::getInstance();

        $query = "SELECT id FROM users WHERE username = :username";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $user = $stmt->fetch();
        if($user != null) return $user;
        else throw new InvalidArgumentException("there is not user with that id");

    }

    public static function insertUser($username, $password, $name, $lastname){

        $dbh = DBInit::getInstance();

        $_SESSION["username"] = $username;
    
        $query = "INSERT INTO users (username, password, name, lastname) VALUES (:username, :password, :name, :lastname)";

        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":password",$password);
        $stmt->bindParam(":name",$name);
        $stmt->bindParam(":lastname",$lastname);
        $stmt->execute();
    }
}
