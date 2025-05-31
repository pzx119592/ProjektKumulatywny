<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}
?>

<!--

-- Tworzenie bazy danych
CREATE DATABASE IF NOT EXISTS BANK;
USE BANK;

-- Tworzenie tabeli transakcji z optymalizacjami
CREATE TABLE IF NOT EXISTS transakcje (
    id INT AUTO_INCREMENT PRIMARY KEY,
    imie VARCHAR(50) NOT NULL DEFAULT '',
    nazwisko VARCHAR(50) NOT NULL DEFAULT '',
    kwota DECIMAL(10,2) NOT NULL CHECK (kwota > 0),
    typ ENUM('wplata', 'wyplac') NOT NULL,
    data_operacji TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (data_operacji) -- Optymalizacja dla szybszego wyszukiwania po dacie
);

-->