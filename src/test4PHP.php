<?php
require_once 'User.php';
require_once 'connection.php';

$user1 = User::loadUserById($conn, 3);
$user1->delete($conn);

$conn->close();
$conn = NULL;



