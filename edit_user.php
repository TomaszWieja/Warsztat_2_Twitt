<?php
//sprawdzamy czy zalogowany
//obsługa formularza - z komunikatem, czy udało się zapisać zmiany
//pobieramy dane zalogowanego użytkownika
session_start();
require_once 'utils/check_login.php';
require_once 'utils/connection.php';
require_once 'src/User.php';

$userLogged = User::loadUserByID($conn, $_SESSION['user_id']);
echo "Jesteś zalogowany jako: " . $userLogged->getUsername()
        . "<br><a href='messages.php'>Twoje wiadomości</a>"
        . "<br><a href='index.php'>Powrót do strony głównej</a>"
        . "<br><a href='logout.php'>Wyloguj się</a>"
        . "<hr>";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['email']) || isset($_POST['userName']) || isset($_POST['password'])) {
        
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
            $result = $userLogged->saveToDB($conn);
            if ($result) {
                header('location: edit_user.php');
            }
        
    }
    
}
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
<form action="" method="post">
    <input type="hidden" name="delete" value="yes">
    <input type="submit" value="Usuń konto">
</form>
<?php
    if (isset($_POST['delete'])) {
        echo    "<form action='' method='post'>"
                    . "<label>Twoje konto będzie trwale usunięte, czy jesteś pewien?</label><br>"
                    . "<select name='del'>"
                    . "<option value='no'>Nie</option>"
                    . "<option value='yes'>Tak</option>"
                    . "</select><br>"
                    . "<input type='hidden' name='delete' value='yes'>"
                    . "<input type='submit' value='Potwierdź'>"
                . "</form>'";
        if (isset($_POST['del'])) {
            var_dump($_POST['del']);
            if ($_POST['del'] == "yes") {
                $delete = $userLogged->delete($conn);
                var_dump($delete);
                if ($delete == TRUE) {
                    $userLogged->logout();
                    header('location: index.php');
                }
            }
            if ($_POST['del'] == "no") {
                header('location: edit_user.php');
            }
        }
    }
?>