<?php

//pobieranie treści wpisu razem z danymi autora (join) i komentarzami do wpisu
//SELECT * FROM post p 
//JOIN users u ON p.author_id = u.id
//        
//JOIN comment c ON c.post_id = p.id
//JOIN users u2 ON u2.id = c.author_id
//        
//WHERE p.id = $_GET['id'];
session_start();
require_once 'utils/check_login.php';
require_once 'utils/connection.php';
require_once 'src/Comment.php';
require_once 'src/Tweet.php';
require_once 'src/User.php';

$userLogged = User::loadUserByID($conn, $_SESSION['user_id']);
echo "Jesteś zalogowany jako: " . $userLogged->getUsername() .
        "<br><a href='messages.php'>Twoje wiadomości</a>"
        . "<br><a href='index.php'>Powrót do strony głównej</a>"
        . "<br><a href='edit_user.php'>Edytuj profil</a>"
        . "<br><a href='logout.php'>Wyloguj się</a><hr>";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $text = $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $postId = filter_input(INPUT_GET, 'postId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if ($text != "") {
        $comment = new Comment();
        $comment->setText($text);
        $comment->setPostId($postId);
        $comment->setUserId($_SESSION['user_id']);
        $comment->setCreationDate(date('Y-m-d H:i:s'));
        $saveToDb = $comment->saveToDB($conn);
        header("location: post.php?postId=" . $postId);
    }
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $postId = (int) filter_input(INPUT_GET, 'postId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (is_integer($postId)) {
        $tweetById = Tweet::loadTweetById($conn, $postId);
        $userById = User::loadUserByID($conn, $tweetById->getUserId());
        echo $tweetById->getText() . " " . $userById->getUsername() . "<br>";
        $commentByPostId = Comment::loadAllCommentsByPostId($conn, $postId);    
        foreach ($commentByPostId as $row) {
            echo $row->getText() . "<br>";
        }
    }
}
?>
<!--Wyświetlanie treści wpisu-->
<!--Wyświetlanie komentarzy do wpisu (autor jako klikalny link)-->
<form action="" method="post">
    <input type="text" name="text"><br>
    <input type="submit" value="Dodaj komentarz">
</form>
