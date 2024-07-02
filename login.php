<?php
include_once 'classes/database.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userId = database::login($username, $password);

    if ($userId) {
        $_SESSION['userid'] = $userId;
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inloggen</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Inloggen</h2>
    <form method="post" action="login.php">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Inloggen">
        <div>Nog geen account? <a href="register.php">Maak een nieuwe account aan</a></div>
    </form>
</div>
</body>
</html>
