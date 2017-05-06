<?php
//Onsługa formularza do rejestracji
//jeśli udało się zapisać - zaloguj i przekieruj na stronę index.php
//$user->login();
//header("Location: index.php");

//jeśli nie udało się zapisać - wyświetl info, że podany adres email jest już zajęty
session_start();
require_once 'utils/connection.php';
require_once 'src/User.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    if ($email != "" && $userName != "" && $password != "") {
        $userEmail = User::loadUserByEmail($conn, $email);
        
        if (!$userEmail) {
            $newUser = new User();
            $newUser->setEmail($email);
            $newUser->setUsername($userName);
            $newUser->setHashedPassword($password);
            $newUser->saveToDB($conn);
            $newUser->login();
            header("location: index.php");
        } else {
            $email = $userEmail->getEmail();
            echo "Podany email: " . $email . " już istnieje, proszę podać inny email!";
        }
    } else {
        echo "Proszę wypełnić wszytskie pola!";
    }
}
?>
<!--Formularz do rejestracji użytkownika-->
<form action="" method="post">
    <label>Email: </label>
    <input type="email" name="email"><br>
    <label>Nazwa użytkownika: </label>
    <input type="text" name="username"><br>
    <label>Hasło: </label>
    <input type="password" name="password"><br>
    <input type="submit" value="Utwórz użytkownika">
</form>
<a href="index.php">Powrót na stronę główną</a>
