<?php

$baseName = "Warsztat_2_Twitter";
$serverName = "localhost";
$userName = "root";
$password = "coderslab";

$conn = new mysqli($serverName, $userName, $password, $baseName);

if ($conn->connect_error) {
    die("Blad: " . $conn->connect_error);
}