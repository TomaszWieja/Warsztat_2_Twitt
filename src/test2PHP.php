<?php

require_once 'User.php';
require_once 'connection.php';

$user1 = User::loadUserById($conn, 3);
var_dump($user1);

$user1->setUsername("Nowe Imie");
$user1->saveToDB($conn);


$conn->close();
$conn = NULL;
