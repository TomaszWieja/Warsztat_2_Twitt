<?php

const DB_HOST = "localhost";
const DB_USER = "root";
const BD_PASSWORD = "coderslab";
const DB_DB = "cinemax_ex";

$conn = new mysqli(DB_HOST, DB_USER, BD_PASSWORD, DB_DB);

if ($conn != TRUE) {
    echo "błąd połączenia";
}