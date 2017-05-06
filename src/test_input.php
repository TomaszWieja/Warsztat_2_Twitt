<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    var_dump($_POST['email']);
    
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    var_dump($email);
    var_dump($_POST['string']);
    $string = filter_input(INPUT_POST, 'string', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    var_dump($string);
}
?>

<form action="" method="post">
    <label>email</label>
    <input type="text" name="email">
    <label>string</label>
    <input type="text" name="string">
    <label>number</label>
    <input type="text" name="number">
    <input type="submit">
</form>