<?php

require_once("ViewHelper.php");
require_once("model/UserDB.php");
require_once("model/FlightDB.php");

class UserController {

    public static function showInitialForm(){
        if (isset($_SESSION["notification"]) || !empty($_SESSION["notification"])) {
            $temp = $_SESSION["notification"];
            echo "<script>alert('.$temp.');</script>";
            unset($_SESSION["notification"]);
        }
        if(isset($_GET["id"])){
                ViewHelper::render("view/initial-page.php", ["flight" => FlightDB::getFlight($_GET["id"])]);
        }else{
                ViewHelper::render("view/initial-page.php", ["flight" => FlightDB::getAllFlights()]);
        } 
    }

    public static function showAdministratorForm(){
        if (isset($_SESSION["notification"]) || !empty($_SESSION["notification"])) {
            $temp = $_SESSION["notification"];
            echo "<script>alert('.$temp.');</script>";
            unset($_SESSION["notification"]);
        }
        if(isset($_GET["id"])){
            ViewHelper::render("view/administrator-page.php", ["flight" => FlightDB::getFlight($_GET["id"])]);
        }else{
            ViewHelper::render("view/administrator-page.php", ["flight" => FlightDB::getAllFlights()]);
        }
    }

    public static function showLoginForm(){
        if (isset($_SESSION["notification"]) || !empty($_SESSION["notification"])) {
            $temp = $_SESSION["notification"];
            echo "<script>alert('.$temp.');</script>";
            unset($_SESSION["notification"]);
        }
        if(isset($_GET["id"])){
            ViewHelper::render("view/logged-in-page.php", ["flight" => FlightDB::getFlight($_GET["id"])]);
        }else{
            ViewHelper::render("view/logged-in-page.php", ["flight" => FlightDB::getAllFlights()]);
        }
    }

    public static function login($username, $password) {
        if (UserDB::validLoginAttempt($username, $password)) {
             $_SESSION["username"] =  $username;
             $_SESSION["password"] = $password;
             $details =  UserDB::getIdByUsername($_SESSION["username"]);
             $_SESSION["id"] = $details["id"];
             if(UserDB::checkIfUserIsAdmin($username)){
                 self::showAdministratorForm();
             }
             else{
                 self::showLoginForm();
             }
        } else {
             $_SESSION["notification"] = "Registration failed";
             ViewHelper::redirect(BASE_URL . "welcome");
        }
     }

    public static function registerUser(){

        $rules = [
            "username" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[a-zA-Zšđčćž0123456789\.\-]+$/"]
            ],
            "password" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[a-zA-Zšđčćž0123456789\.\-]+$/"]
            ],
            "name" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[ a-zA-ZšđčćžŠĐČĆŽ\-]+$/"]
            ],
            "lastname" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[ a-zA-ZšđčćžŠĐČĆŽ\-]+$/"]
            ]
        ];

        $data = filter_input_array(INPUT_POST, $rules);

        $errors["username"] = empty($data["username"]) ? "You need to enter username." : "";
        $errors["password"] = empty($data["password"]) ? "You need to enter password" : "";
        $errors["name"] = empty($data["name"]) ? "You need to enter name" : "";
        $errors["lastname"] = empty($data["lastname"]) ? "You need to enter lastname" : "";
        
        $output = "";
        $valid = true;

        foreach ($errors as $error) {
            $valid = $valid && empty($error);
            $output = $output . $error;
        }

        if ($valid) {
            UserDB::insertUser($data["username"], $data["password"], $data["name"], $data["lastname"]);

            $_SESSION["notification"] = "You registered successfully";
            $_SESSION["username"] = $data["username"];
            $_SESSION["password"] = $data["password"];
            $details =  UserDB::getIdByUsername($data["username"]);
            $_SESSION["id"] = $details["id"];
            
            self::login($_SESSION["username"],$_SESSION["password"]);
        }
        else{
            $_SESSION["notification"] = $output;
            ViewHelper::redirect(BASE_URL . "welcome");
        }
    }    
}