<?php

session_start();

require_once("controller\UserController.php");
require_once("controller\FlightController.php");
require_once("controller\BookedController.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "welcome" => function(){
        session_destroy();
        UserController::showInitialForm();
    },
    "login" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::login($_POST["username"], $_POST["password"]);
        }
        else{
            ViewHelper::redirect(BASE_URL . "welcome");
        }
    },
    "registerUser" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::registerUser();
        }
    },
    "booked" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            BookedController::book();
        }
    },
    "removeFlight"=> function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            FlightController::deleteFlight();
        }
    },
    "add-flight"=> function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            FlightController::insertFlight();
        }
    },
    "" => function(){
        ViewHelper::redirect(BASE_URL . "welcome");
    },
];

try {
    if (isset($urls[$path])) {
       $urls[$path]();
    } else {
        echo "No controller for '$path'";
    }
} catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
}