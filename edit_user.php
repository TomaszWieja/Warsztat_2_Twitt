<?php
//sprawdzamy czy zalogowany
//obsługa formularza - z komunikatem, czy udało się zapisać zmiany
//pobieramy dane zalogowanego użytkownika
session_start();
require_once 'utils/check_login.php';
require_once 'utils/connection.php';
require_once 'src/User.php';

$userLogged = User::loadUserByID($conn, $_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['email'] != "" || $_POST['userName'] != "" || $_POST['password'] != "") {
        if ($_POST['email'] != "") {
            $emailCheck = User::loadUserByEmail($conn, $_POST['email']);
            if (!$emailCheck || $emailCheck->getEmail() == $_POST['email']) {
                $userLogged->setEmail($_POST['email']);
            } else {
                echo "Podany email już istnieje, proszę podać inny.";
            }
        }
        if ($_POST['userName'] != "") {
            $userLogged->setUsername($_POST['userName']);
        }
        if ($_POST['password'] != "") {
            $userLogged->setHashedPassword($_POST['password']);
        }
        $userLogged->saveToDB($conn);
    }
}

echo "Jesteś zalogowany jako: " . $userLogged->getUsername() . "<br><a href='logout.php'>Wyloguj się</a><hr><br>";

?>

<!--formularz do edycji danych użytkownika-->
<form action="" method="post">
    <label>Wpisz nową nazwę użytkownika</label>
    <input type="text" name="userName"><br>
    <label>Wpisz nowy email</label>
    <input type="email" name="email"><br>
    <label>Wpisz nowe hasło</label>
    <input type="password" name="password"><br>
    <input type="submit" value="Edytuj">
</form>