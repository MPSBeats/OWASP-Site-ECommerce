<?php
require_once '../models/database.php';
require_once '../models/productModel.php';
require_once '../models/sellerModel.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Aucun vendeur sélectionné");
}

$seller_id = intval($_GET['id']);

// Récupération des informations du vendeur
$sellerModel = new Seller();
$seller = $sellerModel->getSellerById($seller_id);
if (!$seller) {
    die("Vendeur introuvable");
}

$productModel = new Product();
$products = $productModel->getProductsBySeller($seller_id);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Produits de <?= htmlspecialchars($seller['name']) ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Produits de <?= htmlspecialchars($seller['name']) ?></h1>
    <?php if (empty($products)): ?>
        <p>Aucun produit trouvé pour ce vendeur.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID produit</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['id_product']) ?></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['description']) ?></td>
                        <td><?= htmlspecialchars($product['price']) ?>€</td>
                        <td><img src="<?= htmlspecialchars($product['image_url']) ?>" width="50"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>