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
        <h1>E-commerce</h1>
        <nav>
            <ul>
                <li><a href="index.php?page=home">Accueil</a></li>
                <li><a href="index.php?page=products">Produits</a></li>
                <li><a href="index.php?page=seller">Seller</a></li>
                <li><a href="index.php?page=contact">Contact</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['role'] === 'vendeur'): ?>
                        <li><a href="index.php?page=sellerProfile">Profile</a></li>
                    <?php elseif ($_SESSION['role'] === 'admin'): ?>
                        <li><a href="index.php?page=adminProfile">Profile</a></li>
                    <?php endif; ?>
                    <li><a href="index.php?page=logout">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="index.php?page=login">Connexion</a></li>
                    <li><a href="index.php?page=register">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>
</html>