<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'vendeur') {
    header("Location: index.php?page=login");
    exit();
}

require_once '../models/productModel.php';
$productModel = new Product();
$products = $productModel->getProductsBySeller($_SESSION['user_id']);
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
        <h1>Bienvenue, <?= htmlspecialchars($_SESSION['name'] ?? 'Vendeur') ?>!</h1>
        <form action="index.php?page=logout" method="post" style="display:inline;">
            <button type="submit">Déconnexion</button>
        </form>
    </header>
    <main>
        <section>
            <h2>Tableau de bord</h2>
            <p>Ici vous pouvez gérer vos produits et consulter vos ventes.</p>
            <?php if (!empty($products)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID Produit</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= htmlspecialchars($product['id_product']) ?></td>
                                <td><?= htmlspecialchars($product['name']) ?></td>
                                <td><?= htmlspecialchars($product['description']) ?></td>
                                <td><?= htmlspecialchars($product['price']) ?> €</td>
                                <td>
                                    <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" width="50">
                                </td>
                                <td>
                                    <form action="index.php?page=deleteProduct" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                        <input type="hidden" name="id_product" value="<?= htmlspecialchars($product['id_product']) ?>">
                                        <button type="submit">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun produit trouvé.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>