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

$tweetById = Tweet::loadTweetById($conn, $id);

$commentByPostId = Comment::loadAllCommentsByPostId($conn, $postId);

?>
<!--Wyświetlanie treści wpisu-->
<!--Wyświetlanie komentarzy do wpisu (autor jako klikalny link)-->
<form>
    <input type="text" name="text"><br>
    <input type="submit" value="Dodaj komentarz">
</form>
