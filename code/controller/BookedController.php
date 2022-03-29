<?php

require_once("ViewHelper.php");
require_once("model/UserDB.php");
require_once("model/FlightDB.php");
require_once("controller/UserController.php");

class BookedController {
    public static function book() {
        FlightDB::bookFlight($_SESSION["id"], $_POST["flightID"]);
        $_SESSION["notification"] = "Flight booked successfully!";
        UserController::login($_SESSION["username"], $_SESSION["password"]);
    }
}