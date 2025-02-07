<?php
session_start();
require_once 'Database.php';
require_once 'Product.php';

$productModel = new Product();
$products = $productModel->getProducts();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits disponibles</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Liste des produits disponibles</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Stock</th>
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
                    <td><?= htmlspecialchars($product['stock']) ?></td>
                    <td><img src="<?= htmlspecialchars($product['image_url']) ?>" width="50"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>