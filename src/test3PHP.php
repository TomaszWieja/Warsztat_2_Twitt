<?php

require_once 'User.php';
require_once 'connection.php';

$user1 = User::loadAllUsers($conn);
var_dump($user1);

$conn->close();
$conn = NULL;

