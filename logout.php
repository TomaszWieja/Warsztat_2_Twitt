<?php
session_start();
require_once 'src/User.php';

$logout = new User();
$logout->logout();

if (!isset($_SESSION['user_id'])) {
    echo "Zostałeś poprawnie wylogowany.<br>";
    echo "<a href='login.php'>Zaloguj ponownie</a>";
}
?>

