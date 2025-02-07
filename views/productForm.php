<?php
require_once "../models/productModel.php";
require_once "../models/database.php";

$productModel = new Product();


if (isset($_GET['product']) && !empty($_GET['product'])) {
    $selectedProduct = $productModel->getProductById($_GET['product']);
    $currentProduct = $title = htmlspecialchars($selectedProduct['name']);
} else {
    header('Location: index.php?page=products');
    exit();
}

?>

<main>
    <h1><?php echo $title; ?></h1>
    <div class="product">
        <img src="<?php echo htmlspecialchars($selectedProduct['image_url']); ?>" alt="<?php echo htmlspecialchars($selectedProduct['name']); ?>">
        <h2><?php echo htmlspecialchars($selectedProduct['name']); ?></h2>
        <p><?php echo htmlspecialchars($selectedProduct['description']); ?></p>
        <p><?php echo htmlspecialchars($selectedProduct['price']); ?> €</p>
        <p>Vendu par: <?php echo htmlspecialchars($selectedProduct['seller_name']); ?></p>
        <a href="index.php?page=products">Retour à la liste des produits</a>
    </div>
    <div class="form">
        <form action="index.php?page=product&id=<?php echo $selectedProduct['id_product']; ?>" method="post">
            <label for="quantity">Quantité</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" max="100">
            <input type="submit" value="Ajouter au panier">
        </form>
    </div>
</main>
