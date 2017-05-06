<?php
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

?>
<!--  Formualrz dodawania wpisu  -->

<!--  Link do wiadomości zalogowanego użytkownika  -->
<!--  Link do edycji danych zalogowanego użytkownika  -->

<!--  Lista wpisów (jako linki do post.php?id=xxx   -->
<form action="" method="post">
    <input type="text" name="text"><br>
    <input type="submit" value="Wyślij wiadomość">
</form>
<?php
//Sprawdź czy użytkownik jest zalogowany

//obsługa formularza dodawania wpisu

//pobieranie listy wpisu
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if ($text != "") {

        $newTweet = new Tweet();
        $newTweet->setText($text);
        $newTweet->setUserId($_SESSION['user_id']);
        $newTweet->setCreationDate(date('Y-m-d H:i:s'));
        $newTweet->saveToDB($conn);
    }
}

$allTweets = Tweet::loadAllTweets($conn);
foreach ($allTweets as $value) {
    $userId = $value->getUserId();
    $postId = $value->getId();
    $user = User::loadUserByID($conn, $userId);
    $userName = $user->getUsername();
    echo "<a href='post.php?postId=" . $postId . "'>" . $value->getText() . "</a> " . $value->getCreationDate() . " " . 
            "<a href='user.php?userId=$userId'>" . $userName . "</a><br>";
}
?>