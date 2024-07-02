<?php
include_once 'classes/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];
    $postcode = $_POST['postcode'];
    $huisnummer = $_POST['huisnummer'];
    $woonplaats = $_POST['woonplaats'];

    if ($password === $password_repeat) {
        if (database::register($username, $password, $postcode, $huisnummer, $woonplaats)) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error during registration.";
        }
    } else {
        echo "Passwords do not match.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registreren</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Registreren</h2>
    <form method="post" action="register.php">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required>

        <label for="password_repeat">Herhaal wachtwoord:</label>
        <input type="password" id="password_repeat" name="password_repeat" required>

        <label for="postcode">Postcode:</label>
        <input type="text" id="postcode" name="postcode" required>

        <label for="huisnummer">Huisnummer:</label>
        <input type="text" id="huisnummer" name="huisnummer" required>

        <label for="woonplaats">Woonplaats:</label>
        <input type="text" id="woonplaats" name="woonplaats" required>

        <input type="submit" value="Registreren">
    </form>
</div>
</body>
</html>
