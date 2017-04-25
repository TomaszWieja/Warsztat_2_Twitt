<?php

require_once 'User.php';
require_once 'connection.php';

$user1 = new User();

$user1->setEmail("email1@email.pl");
$user1->setUsername("Jan Kowalski");
$user1->setHashedPassword("TajneHaslo");
$user1->saveToDB($conn);
var_dump($user1);

$conn->close();
$conn = NULL;