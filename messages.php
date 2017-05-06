<?php
//sprawdzamy czy zalogowany

//pobieramy wszystkei wiadomości, których użytkownik jest nadawcą lub odbiorcą

// .... WHERE author_id = $_SESSION['user_id'] OR recipient_id = $_SESSION['user_id']
session_start();
require_once 'utils/check_login.php';
require_once 'utils/connection.php';
require_once 'src/Message.php';
require_once 'src/User.php';

$userLogged = User::loadUserByID($conn, $_SESSION['user_id']);
echo "Jesteś zalogowany jako: " . $userLogged->getUsername() .
        "<br><a href='index.php'>Powrót do strony głównej</a>"
        . "<br><a href='edit_user.php'>Edytuj profil</a>"
        . "<br><a href='logout.php'>Wyloguj się</a>"
        . "<hr>";


echo 'Wiadomości odebrane:<br>';
$messagesReceived = Message::loadMessagesByReceiverId($conn, $_SESSION['user_id']);

foreach ($messagesReceived as $messageRec) {
    $senderName = User::loadUserByID($conn, $messageRec->getSenderId());
    if ($messageRec->getSee() != 1) {
        $seeSend = "Nieprzeczytana";
    } else {
        $seeSend = "Przeczytana";
    }
    echo "<a href='user.php?userId=" . $messageRec->getSenderId() . "'>" . $senderName->getUsername() . "</a> <a href='message.php?messageId=" . $messageRec->getId() . "&see=1'>" . $seeSend . $messageRec->getText() . "</a>" . $messageRec->getCreationDate() . "<br>";
}

echo 'Wiadomości wysłane:<br>';
$messagesSent = Message::loadMessagesBySenderId($conn, $_SESSION['user_id']);

foreach ($messagesSent as $messageS) {
    $receiverName = User::loadUserByID($conn, $messageS->getReceiverId());
    if ($messageS->getSee() != 1) {
        $SeeRec = "Nieprzeczytana przez odbiorcę";
    } else {
        $SeeRec = "Przeczytana przez odbiorcę";
    }
    echo "<a href='user.php?userId=" . $messageS->getReceiverId() . "'>" . $receiverName->getUsername() . "</a> <a href='message.php?messageId=" . $messageS->getId() . "'>" . $SeeRec . $messageS->getText() . "</a>" . $messageS->getCreationDate() . "<br>";
}
?>

<!--Klikalna lista wiadomości ( tylko pierwsze 30 znaków )-->