<?php

//sprawdzić czy użytkownik jest zalogowany

//pobrać dane użytkownika i wszystkie jego wpisy
//SELECT * FROM User u JOIN post p ON p.author_id = u.id WHERE u.id = $_GET['id'];

//SELECT p.*, COUNT(c.id) FROM post p 
//JOIN comment c ON c.post_id = p.id
//WHERE p.author_id = $_GET['id']
//GROUP BY p.id; - lista wpisów wraz z liczbą komentarzy
session_start();
require_once 'utils/connection.php';
require_once 'utils/check_login.php';
require_once 'src/Tweet.php';

$tweetsByUserId = Tweet::loadAllTweetsByUserId($conn, $_SESSION['user_id']);

foreach ($tweetsByUserId as $row) {
    echo $row['text'] . "<br>";
}
?>

<!--Formularz do wysyłania wiadomości do użytkownika-->

<!--Lista wpisów użytkownika-->


