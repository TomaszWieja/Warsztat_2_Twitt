<?php

$baseName = "cinemas_ex";
$serverName = "localhost";
$userName = "root";
$password = "";

$conn = new mysqli($serverName, $userName, $password, $baseName);

if ($conn->connect_error) {
    die("Blad: " . $conn->connect_error);
}