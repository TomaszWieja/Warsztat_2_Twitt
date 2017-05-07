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


echo '<h4>Wiadomości odebrane:</h4><br>';
echo "<table>"
        . "<tr>"
            . "<th>Nadawca</th><th>Przeczytana</th><th>Treść wiadomości</th><th>Data wysłania</th>"
        . "</tr>";
$messagesReceived = Message::loadMessagesByReceiverId($conn, $_SESSION['user_id']);

foreach ($messagesReceived as $messageRec) {
    $senderName = User::loadUserByID($conn, $messageRec->getSenderId());
    if ($messageRec->getSee() != 1) {
        $seeSend = "Nie";
    } else {
        $seeSend = "Tak";
    }
    if (strlen($messageRec->getText()) > 30) {
        $messageRecCut = substr($messageRec->getText(), 0, 30) . "...";
    } else {
        $messageRecCut = $messageRec->getText();
    }
    echo "<tr><td><a href='user.php?userId=" . $messageRec->getSenderId() . "'>" . $senderName->getUsername() . "</a></td><td>" . $seeSend . "</td><td><a href='message.php?messageId=" . $messageRec->getId() . "&see=1'>" . $messageRecCut . "</a></td><td>" . $messageRec->getCreationDate() . "</td></tr>";
}
echo "</table>";
echo '<h4>Wiadomości wysłane:</h4><br>';
echo "<table>"
        . "<tr>"
            . "<th>Odbiorca</th><th>Przeczytana</th><th>Treść wiadomości</th><th>Data wysłania</th>"
        . "</tr>";
$messagesSent = Message::loadMessagesBySenderId($conn, $_SESSION['user_id']);

foreach ($messagesSent as $messageS) {
    $receiverName = User::loadUserByID($conn, $messageS->getReceiverId());
    if ($messageS->getSee() != 1) {
        $SeeRec = "Nie";
    } else {
        $SeeRec = "Tak";
    }
    if (strlen($messageS->getText()) > 30) {
        $messageSCut = substr($messageS->getText(), 0, 30) . "...";
    } else {
        $messageSCut = $messageS->getText();
    }
    echo "<tr><td><a href='user.php?userId=" . $messageS->getReceiverId() . "'>" . $receiverName->getUsername() . "</a></td><td>" . $SeeRec . "</td><td><a href='message.php?messageId=" . $messageS->getId() . "'>" . $messageSCut . "</a></td><td>" . $messageS->getCreationDate() . "</td></tr>";
}
?>

<!--Klikalna lista wiadomości ( tylko pierwsze 30 znaków )-->