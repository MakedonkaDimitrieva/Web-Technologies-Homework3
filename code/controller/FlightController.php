<?php

require_once("ViewHelper.php");
require_once("model/UserDB.php");
require_once("model/FlightDB.php");

class FlightController {

    public static function insertFlight(){
        
        $rules = [
            "flightID" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[a-zA-ZšđčćžŠĐČĆŽ0123456789]+$/"]
            ],
            "departure" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[a-zA-ZšđčćžŠĐČĆŽ]+$/"]
            ],
            "destination" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[a-zA-ZšđčćžŠĐČĆŽ]+$/"]
            ],
            "departure_date" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/"]
            ],
            "class" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[a-zA-ZšđčćžŠĐČĆŽ]+$/"]
            ],
            "company" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[a-zA-ZšđčćžŠĐČĆŽ]+$/"]
            ],
            "price" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[ 0123456789\.\-]+$/"]
            ]
        ];

        $data = filter_input_array(INPUT_POST, $rules);

        $errors["flightID"] = empty($data["flightID"]) ? "You need to enter the flight code" : "";
        $errors["departure"] = empty($data["departure"]) ? "You need to enter the departure city" : "";
        $errors["destination"] = empty($data["destination"]) ? "You need to enter the destination ciy" : "";
        $errors["departure_date"] = empty($data["departure_date"]) ? "You need to enter the date of departure" : "";
        $errors["class"] = empty($data["class"]) ? "You need to enter the class of the flight" : "";
        $errors["company"] = empty($data["company"]) ? "You need to enter the name of the company" : "";
        $errors["price"] = empty($data["price"]) ? "You need to enter the price of the flight" : "";

        $output = "";
        $valid = true;
        foreach ($errors as $error) {
            $valid = $valid && empty($error);
            $output = $output . $error;
        }
        if ($valid) {
            FlightDB::insertFlight($data["flightID"], $data["departure"], $data["destination"], 
            $data["departure_date"], $data["class"], $data["company"], $data["price"]);

            $_SESSION["notification"] = "Flight added";
            UserController::login($_SESSION["username"],$_SESSION["password"]); 
        }
        else{
            $_SESSION["notification"] = $output;
            UserController::login($_SESSION["username"],$_SESSION["password"]); 
        }
    }

    public static function deleteFlight(){
        FlightDB::deleteFlight($_POST["flightID"]);
        $_SESSION["notification"] = "Deleted";
        UserController::login($_SESSION["username"],$_SESSION["password"]);     
    }
}