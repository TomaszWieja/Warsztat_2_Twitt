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

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['text'] != "") {
        $comment = new Comment();
        $comment->setText($_POST['text']);
        $comment->setPostId($_GET['postId']);
        $comment->setUserId($_SESSION['user_id']);
        $comment->setCreationDate(date('Y-m-d H:m:s'));
        $saveToDb = $comment->saveToDB($conn);
        header("location: post.php?postId=" . $_GET['postId']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $postId = (int) $_GET['postId'];
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
