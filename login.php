<?php
//obsługa formularza logowania
//czy w bazie jest użytkownik o podanym emailu i haśle?
//jeśli tak - zaloguj
//jeśli nie - wyświetl komunikat
session_start();
require_once 'src/User.php';
require_once 'utils/connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($email != "" && $password != "") {
        $userEmail = User::loadUserByEmail($conn, $email);
        if ($userEmail) {
            $id = $userEmail->getId();
            $emailIns = $userEmail->getEmail();
            $hashedPassword = $userEmail->getHashedPassword();
              
            if ($emailIns == $email && password_verify($password, $hashedPassword)) {
                
                $login = User::loadUserByID($conn, $id);
                $login->login();
                header("location: index.php");
            } else {
                echo "Błędny login lub hasło.";
            }
        } else {
            echo "Błędny login lub hasło.";
        }
    } else {
        echo "Błędny login lub hasło.";
    }
}
?>

<!--Formuarz do logowania-->

<!--link do rejestracji konta-->
<form action="" method="post">
    <label>Podaj email</label>
    <input type="text" name="email"><br>
    <label>Podaj hasło</label>
    <input type="password" name="password"><br>
    <input type="submit" value="Zaloguj">
</form>
<a href="register.php">Utwórz konto</a>