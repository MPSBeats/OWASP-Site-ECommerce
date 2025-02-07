<?php
require_once "../models/productModel.php";
require_once "../models/database.php";

$productModel = new Product();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Récupérer le produit par son ID
    $selectedProduct = $productModel->getProductById($_GET['id']);
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
        <a href="index.php?page=seller">Vendu par: <?php echo htmlspecialchars($selectedProduct['seller_name']); ?></a>
        <a href="index.php?page=products">Retour à la liste des produits</a>
    </div>
    
    <div class="form">
        <form action="index.php?page=products" method="post" id="addToCartForm">
            <label for="quantity">Quantité</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" max="100">
            <input type="submit" value="Ajouter au panier">
        </form>
    </div>
</main>

<script>
    document.getElementById("addToCartForm").addEventListener("submit", function(event) {

        alert("Produit ajouté au panier !");

    });
</script>
