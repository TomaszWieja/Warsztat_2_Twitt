<?php
//sprawdzamy czy zalogowany

//pobieramy wszystkei wiadomości, których użytkownik jest nadawcą lub odbiorcą

// .... WHERE author_id = $_SESSION['user_id'] OR recipient_id = $_SESSION['user_id']
require_once 'src/Tweet.php';
require_once 'utils/connection.php';

$tweetsByUserId = Tweet::loadAllTweetsByUserId($conn, $userId);

?>

<!--Klikalna lista wiadomości ( tylko pierwsze 30 znaków )-->