<?php
session_start();


if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}
include_once 'classes/database.php';

$userId = $_GET['id'] ?? null;
$userData = [];

if ($userId) {
    $conn = database::connect();
    $stmt = $conn->prepare("SELECT * FROM user WHERE userid = :userid");
    $stmt->bindParam(':userid', $userId);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $postcode = $_POST['postcode'];
    $huisnummer = $_POST['huisnummer'];
    $woonplaats = $_POST['woonplaats'];

    $conn = database::connect();
    $stmt = $conn->prepare("UPDATE user SET postcode = :postcode, huisnummer = :huisnummer, woonplaats = :woonplaats WHERE userid = :userid");
    $stmt->bindParam(':postcode', $postcode);
    $stmt->bindParam(':huisnummer', $huisnummer);
    $stmt->bindParam(':woonplaats', $woonplaats);
    $stmt->bindParam(':userid', $userId);
    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit gebruiker <?= $userData['username'] ?? '' ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="hulptext">Met deze pagina kan een gebruiker worden gewijzigd, direct daarna stuurt deze je terug naar de <span class="bold">index.php</span> pagina.</div>

<div class="container">
    <h1>Edit gebruiker <?= $userId ?></h1>
    <form method="post" action="edit.php?id=<?= $userId ?>">
        <label for="postcode">Postcode:</label>
        <input type="text" id="postcode" name="postcode" required value="<?= $userData['postcode'] ?? '' ?>">

        <label for="huisnummer">Huisnummer:</label>
        <input type="text" id="huisnummer" name="huisnummer" required value="<?= $userData['huisnummer'] ?? '' ?>">

        <label for="woonplaats">Woonplaats:</label>
        <input type="text" id="woonplaats" name="woonplaats" required value="<?= $userData['woonplaats'] ?? '' ?>">

        <input type="submit" value="Wijzig">
    </form>
</div>

</body>
</html>
