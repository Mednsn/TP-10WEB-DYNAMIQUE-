<?php
session_start();
require 'config.php';

if (isset($_POST['afaire']) && $_POST['afaire'] == 'deconnexion') {
    session_destroy();
    header('Location: login.php?error=3');
    exit;
}

if (empty($_POST['login']) || empty($_POST['pass'])) {
    header('Location: login.php?error=1');
    exit;
}

if ($_POST['login'] != USERLOGIN || $_POST['pass'] != USERPASS) {
    header('Location: login.php?error=2');
    exit;
}

$_SESSION['CONNECT'] = 'OK';
$_SESSION['login'] = $_POST['login'];
$_SESSION['pass'] = $_POST['pass'];

header('Location: accueil.php');
exit;
?>