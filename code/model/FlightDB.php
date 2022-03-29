<?php

require_once "DBInit.php";

class FlightDB {


    public static function getAllFlights() {

        $dbh = DBInit::getInstance();

        $query = "SELECT * FROM flights";
        $stmt = $dbh->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function getFlight($flightID) {

        $dbh = DBInit::getInstance();

        $query = "SELECT * FROM flights WHERE flightID = :flightID";
        $stmt->$dbh->prepare($query);
        $stmt->bindParam(":flightID", $id, PDO::PARAM_INT);
        $stmt->execute();

        $flight =$stmt->fetch();
        if($flight != null) return $flight;
        else throw new InvalidArgumentException("there is not a flight with that id");
    }

    public static function insertFlight($flightID, $departure, $destination, $departure_date, $class, $company, $price) {

        $dbh = DBInit::getInstance();

        $query = "INSERT INTO flights VALUES (:flightID, :departure, :destination, :departure_date, :class, :company, :price)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":flightID", $flightID);
        $stmt->bindParam(":departure", $departure);
        $stmt->bindParam(":destination", $destination);
        $stmt->bindParam(":departure_date", $departure_date);
        $stmt->bindParam(":class", $class);
        $stmt->bindParam(":company", $company);
        $stmt->bindParam(":price", $price);
        $stmt->execute();
    }

    public static function deleteFlight($flightID) {

        $dbh = DBInit::getInstance();

        $query = "DELETE FROM flights WHERE flightID = :flightID";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":flightID", $flightID);
        $stmt->execute();
    }

    public static function bookFlight($userID, $flightID) {

        $dbh = DBInit::getInstance();

        $query = "INSERT INTO booked VALUES (:userID, :flightID)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":userID", $userID);
        $stmt->bindParam(":flightID", $flightID);
        $stmt->execute();
    }

}