<?php
session_start();

$page = $_GET['page'] ?? 'home';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
</head>

<body>
    <header>
        <h1>Bienvenue sur notre boutique</h1>
        <nav>
            <ul>
                <li><a href="index.php?page=home">Accueil</a></li>
                <li><a href="index.php?page=login">Connexion</a></li>
                <li><a href="index.php?page=register">Inscription</a></li>
                <li><a href="index.php?page=contact">Contact</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>
