drop database if exists airlines;
create database airlines;
use airlines;

CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL,
    `username` VARCHAR(20) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `name` VARCHAR(20) NOT NULL,
    `lastname` VARCHAR (20) NOT NULL,
    `administrator` int(11) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
);

INSERT INTO `users` VALUES
(1, 'administrator', 'test', 'Makedonka', 'Dimitrieva', 1),
(2, 'user1', 'password1', 'Jane', 'Doe', 0);

ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

CREATE TABLE IF NOT EXISTS `flights` (
    `flightID` VARCHAR(10) NOT NULL,
    `departure` VARCHAR(20) NOT NULL,
    `destination` VARCHAR(20) NOT NULL,
    `departure_date` date NOT NULL,
    `class` VARCHAR(20) NOT NULL,
    `company` VARCHAR (20) NOT NULL,
    `price` float NOT NULL,
    PRIMARY KEY (`flightID`)
);

INSERT INTO `flights` VALUES
('F001', 'Vienna', 'Paris', '2021-06-01', 'first', 'AirFrance', 200.0),
('F002', 'Zagreb', 'Berlin', '2021-06-02', 'economy', 'WizzAir', 150.0),
('F003', 'Ljubljana', 'Amsterdam','2021-06-03', 'economy', 'Lufthansa', 300.0),
('F004', 'Istanbul', 'London', '2021-06-04', 'business', 'TurkishAirlines', 500.0),
('F005', 'Belgrade', 'Rome', '2021-06-05', 'economy', 'RyanAir', 250.0),
('F006', 'Istanbul', 'Brussels', '2021-06-06', 'business', 'TurkishAirlines', 500.0),
('F007', 'Oslo', 'Moscow', '2021-06-07', 'first', 'RyanAir', 400.0),
('F008', 'Warsaw', 'Madrid', '2021-06-08', 'economy', 'WizzAir', 200.0);

CREATE TABLE IF NOT EXISTS `booked` (
    `userID` int NOT NULL,
    `flightID` VARCHAR(10) NOT NULL,
    PRIMARY KEY (`userID`, `flightID`)
);

