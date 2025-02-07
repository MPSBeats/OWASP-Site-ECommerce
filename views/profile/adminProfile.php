<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php?page=login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Administrateur</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Bienvenue, Administrateur!</h1>
        <nav>
            <ul>
                <li><a href="index.php?page=manageUsers">Gérer les utilisateurs</a></li>
                <li><a href="index.php?page=manageProducts">Gérer les produits</a></li>
                <li><a href="index.php?page=manageCategories">Gérer les catégories</a></li>
            </ul>
        </nav>
        <a href="index.php?page=logout">Déconnexion</a>
    </header>
    <main>
        <section>
            <h2>Tableau de bord</h2>
            <p>Ici vous pouvez gérer l'ensemble des éléments du site.</p>
        </section>
    </main>
</body>
</html>