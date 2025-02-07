<?php
require_once "../models/productModel.php";
require_once "../models/database.php";

$productModel = new Product();
$products = $productModel->getProducts();
?>

<main>
    <h1>Produits</h1>
    <div class="products">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p><?php echo htmlspecialchars($product['price']); ?> €</p>
                <a href="index.php?page=product&id=<?php echo $product['id']; ?>">Voir le produit</a>
            </div>
        <?php endforeach; ?>
    </div>
</main>