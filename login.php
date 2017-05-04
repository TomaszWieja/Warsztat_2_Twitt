<?php
//obsługa formularza logowania
//czy w bazie jest użytkownik o podanym emailu i haśle?
//jeśli tak - zaloguj
//jeśli nie - wyświetl komunikat
session_start();
require_once 'src/User.php';;
require_once 'utils/connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['email'] != "" && $_POST['password'] != "") {
        $userEmail = User::loadUserByEmail($conn, $_POST['email']);
        if ($userEmail) {
            $id = $userEmail->getId();
            $email = $userEmail->getEmail();
            $hashedPassword = $userEmail->getHashedPassword();
              
            if ($email == $_POST['email'] && password_verify($_POST['password'], $hashedPassword)) {
                
                $login = User::loadUserByID($conn, $id);
                $login->login();
                header("location: index.php");
            } else {
                echo "Błędny login lub hasło.";
            }
        } else {
            echo "Podany email nie jest zarejestrowany";
        }
    } else {
        echo "Proszę wypełnić wszytskie pola";
    }
}
?>

<!--Formuarz do logowania-->

<!--link do rejestracji konta-->
<form action="" method="post">
    <input type="email" name="email"><br>
    <input type="password" name="password"><br>
    <input type="submit" value="Zaloguj">
</form>
<a href="register.php">Utwórz konto</a>