<?php
session_start();
session_destroy();
header("Location: login.php");
exit();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logout</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="hulptext">Deze pagina logt een gebruiker uit en stuurt deze <span class="underline">direct</span> terug naar de <span class="bold">login.php</span> pagina.

</body>
</html>
