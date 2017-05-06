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
require_once 'src/User.php';
require_once 'src/Comment.php';
require_once 'src/Message.php';

$userLogged = User::loadUserByID($conn, $_SESSION['user_id']);
echo "Jesteś zalogowany jako: " . $userLogged->getUsername()
        . "<br><a href='messages.php'>Twoje wiadomości</a>"
        . "<br><a href='index.php'>Powrót do strony głównej</a>"
        . "<br><a href='logout.php'>Wyloguj się</a>"
        . "<hr>";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $newmessage = $_POST['text'];
    if ($newmessage != "") {
        $userId = $_POST['userId'];
        $newMessage = new Message();
        $newMessage->setSenderId($_SESSION['user_id']);
        $newMessage->setReceiverId($userId);
        $newMessage->setCreationDate(date('Y-m-d H:i:s'));
        $newMessage->setText($_POST['text']);
        $newMessage->saveToDB($conn);

        if ($newMessage) {
            echo "Wiadomość została wysłana<br>";
            echo "<a href='user.php?userId=" . $userId . "'>Powrót do strony użytkownika</a>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $userId = (int) $_GET['userId'];
    if (is_integer($userId)) {
        $user = User::loadUserByID($conn, $userId);
        $userName = $user->getUsername();
        echo "Aktywność użytkownika: " . $userName . "<hr>";
        $tweetsByUserId = Tweet::loadAllTweetsByUserId($conn, $userId);    
        foreach ($tweetsByUserId as $row) {
            echo $row->getText() . $row->getCreationDate() . "<br>";
            $commentsByTweetId = Comment::loadAllCommentsByPostId($conn, $row->getId());
            echo "Ilość komentarzy: " . count($commentsByTweetId) . "<br>";
        }
        echo '<form action="" method="post">  
                <input type="text" name="text"><br>
                <input type="hidden" name="userId" value="' . $userId . '">
                <input type="submit" value="Wyślij wiadomość">
            </form>';
    }
}

?>
<!--Formularz do wysyłania wiadomości do użytkownika-->

<!--Lista wpisów użytkownika-->
