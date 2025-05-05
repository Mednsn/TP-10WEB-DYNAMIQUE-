<?php
session_start();

if (!isset($_SESSION['CONNECT']) || $_SESSION['CONNECT'] != 'OK') {
    header('Location: login.php');
    exit;
}

if (isset($_GET['afaire']) && $_GET['afaire'] == 'deconnexion') {
    session_destroy();
    header('Location: validation.php?afaire=deconnexion');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p>Hello <?php echo $_SESSION['login']; ?></p>
    <a href="accueil.php?afaire=deconnexion">Déconnexion</a>
</body>
</html>