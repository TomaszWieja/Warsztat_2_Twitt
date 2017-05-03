<?php
//Sprawdź czy użytkownik jest zalogowany

//obsługa formularza dodawania wpisu

//pobieranie listy wpisu
require_once 'src/Tweet.php';
require_once 'utils/connection.php';

$allTweets = Tweet::loadAllTweets($conn);
foreach ($allTweets as $row) {
    echo $row['text'] . "<br>";
}

?>
<form>
    <input type="text" name="text"><br>
    <input type="submit" value="Wyślij wiadomość">
</form>
<!--  Formualrz dodawania wpisu  -->

<!--  Link do wiadomości zalogowanego użytkownika  -->
<!--  Link do edycji danych zalogowanego użytkownika  -->

<!--  Lista wpisów (jako linki do post.php?id=xxx   -->
