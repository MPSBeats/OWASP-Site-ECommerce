<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'vendeur') {
    header("Location: index.php?page=login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Vendeur</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Bienvenue, Vendeur !</h1>
        <nav>
            <ul>
                <li><a href="index.php?page=manageMyProducts">Mes produits</a></li>
                <li><a href="index.php?page=addProduct">Ajouter un produit</a></li>
            </ul>
        </nav>
        <a href="index.php?page=logout">Déconnexion</a>
    </header>
    <main>
        <section>
            <h2>Tableau de bord</h2>
            <p>Ici vous pouvez gérer vos produits et consulter vos ventes.</p>
        </section>
    </main>
</body>
</html>