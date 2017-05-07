<?php
//Sprawdź czy użytkownik jest zalogowany
//obsługa formularza dodawania wpisu
//pobieranie listy wpisu
session_start();
require_once 'utils/check_login.php';
require_once 'src/Tweet.php';
require_once 'src/User.php';
require_once 'utils/connection.php';

$userLogged = User::loadUserByID($conn, $_SESSION['user_id']);
echo "Jesteś zalogowany jako: " . $userLogged->getUsername() . 
        "<br><a href='messages.php'>Twoje wiadomości</a>"
        . "<br><a href='edit_user.php'>Edytuj profil</a>"
        . "<br><a href='logout.php'>Wyloguj się</a>"
        . "<hr>";

$textCut = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    if (strlen($text) > 140) {
        echo "Post nie może mieć więcej niż 140 znaków!<br>";
        $textCut = substr($text, 0, 140);
    } else {
        if ($text != "") {

            $newTweet = new Tweet();
            $newTweet->setText($text);
            $newTweet->setUserId($_SESSION['user_id']);
            $newTweet->setCreationDate(date('Y-m-d H:i:s'));
            $newTweet->saveToDB($conn);
        }
    }
}
?>
<form action="" method="post">
    <textarea type="text" name="text" cols="100" rows="3" placeholder="Wpisz post..."><?php echo $textCut; ?></textarea><br>
    <input type="submit" value="Wyślij post">
</form>
<?php

$allTweets = Tweet::loadAllTweets($conn);
echo "<table>";
foreach ($allTweets as $value) {
    $userId = $value->getUserId();
    $postId = $value->getId();
    $user = User::loadUserByID($conn, $userId);
    $userName = $user->getUsername();
    echo "<tr><td><a href='user.php?userId=$userId'>" . $userName . " napisał: </a></td><td style='text-align: right'>" . $value->getCreationDate() . "</td></tr><tr><td colspan='2' width='600px' style='font-style: italic'><a href='post.php?postId=" . $postId . "'>" . $value->getText() . "</a></td></tr>";
}
echo "</table>";
?>
