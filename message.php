<?php
//sprawdzimy czy zalogowany

//pobierz wiadomość z bazy na podstawie $_GET['id']
//JOIN users aby pobrać nazwę nadawcy i jeszcze raz JOIN users żeby pobrać nazwę odbiorcy

//SELECT * FROM Message m
//JOIN users ua ON m.author_id = ua.id
//JOIN users ur ON ur.id = m.recipient
//WHERE m.id = $_GET['id']
//        - mysql_real_escape_string();
session_start();
require_once 'utils/check_login.php';
require_once 'utils/connection.php';
require_once 'src/Message.php';
require_once 'src/User.php';

$userLogged = User::loadUserByID($conn, $_SESSION['user_id']);
echo "Jesteś zalogowany jako: " . $userLogged->getUsername() .
        "<br><a href='edit_user.php'>Edytuj profil</a>"
        . "<br><a href='logout.php'>Wyloguj się</a>"
        . "<br><a href='messages.php'>Twoje wiadomości</a>"
        . "<br><a href='index.php'>Powrót do strony głównej</a><hr>";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $messageId = (int) filter_input(INPUT_GET, 'messageId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $seeId = (int) filter_input(INPUT_GET, 'see', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (isset($messageId)) {
        $message = Message::loadMessagesById($conn, $messageId);
        
        if ($seeId == 1) {
            $see = new Message();
            $see->setSeeById($conn, $messageId);
        }
        echo $message->getSenderId() . $message->getText() . $message->getCreationDate() . "<br>";
    }
}
