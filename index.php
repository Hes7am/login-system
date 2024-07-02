<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include_once 'classes/database.php';
$users = database::getUsers();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proeve van bekwaamheid - 2024 - level 3 / 4</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header>
        <h1>Proeve van bekwaamheid - 2024 - level 3 / 4</h1>
        <p>Welkom <?php echo htmlspecialchars($_SESSION['username']); ?>, je bent <span class="bold">ingelogd</span> in het systeem. Op deze pagina kun je de onderstaande gebruikers wijzigen.
            Je kun het adres (postcode, huisnummer en woonplaats) van de gebruiker wijzigen door op het potloodje te klikken.
        </p>
        <div>
            <nav>
                <ul>
                    <li><a href="logout.php">Uitloggen</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="hulptext">Deze pagina zou alleen getoond mogen worden wanneer een gebruiker is ingelogd, in alle andere gevallen word je naar de <span class="bold">login.php</span> pagina gestuurd.
        <br><br>Onderstaande tabel zijn demo gebruikers en dient als inspiratie (tip: kijk goed naar de HTML en bouw deze na met PHP). Jij moet hier de gebruikers uit de user tabel tonen</div>

    <div class="usertable">
        <div>
            <table>
                <tr>
                    <th></th>
                    <th>Gebruikersnaam</th>
                    <th>Postcode</th>
                    <th>Huisnummer</th>
                    <th>Woonplaats</th>
                </tr>
                <?php
                if (!empty($users)) {
                    foreach ($users as $user) {
                        echo "<tr>";
                        echo "<td><a href='edit.php?id=" . $user['userid'] . "'><i class='fas fa-edit'></i></a></td>";
                        echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['postcode']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['huisnummer']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['woonplaats']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Geen gebruikers gevonden</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
