<?php
session_start();
$error = isset($_GET['error']) ? $_GET['error'] : null;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    if ($error == 1) {
        echo "<p>Veuillez saisir un login et un mot de passe</p>";
    } elseif ($error == 2) {
        echo "<p>Erreur de login/mot de passe</p>";
    } elseif ($error == 3) {
        echo "<p>Vous avez été déconnecté du service</p>";
    }
    ?>
    <form action="validation.php" method="post">
        Login: <input type="text" name="login"><br>
        Mot de passe: <input type="password" name="pass"><br>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>