<?php
$page = (isset($_GET['page'])) ? $_GET['page'] : 'home';
$user = (isset($_GET['user'])) ? $_GET['user'] : '';

require_once "../models/productModel.php";
$productId = isset($_GET['id']) ? $_GET['id'] : null;

switch ($page) {
    case 'home':
        include '../views/home.php';
        break;

    case 'login':
        include '../views/login.php';
        break;

    case 'register':
        include '../views/register.php';
        break;

    case 'contact':
        include '../views/contact.php';
        break;

    case 'products':
        if ($productId) {
            $productModel = new Product();
            $selectedProduct = $productModel->getProductById($productId);
            include '../views/productForm.php';
        } else {
            include '../views/products.php';
        }
        break;

    case 'seller':
        include '../views/seller.php';
        break;

    case 'sellerProducts':
        include '../views/sellerProducts.php';
        break;

    case 'sellerProfile':
        include '../views/profile/sellerProfile.php';
        break;
    case 'deleteProduct':
        require_once "../models/productModel.php";
        $productModel = new Product();
        if (isset($_POST['id_product'])) {
            $idProduct = intval($_POST['id_product']);
            $productModel->deleteProduct($idProduct);
        }
        header("Location: index.php?page=sellerProfile");
        exit();
        break;

    case 'adminProfile':
        include '../views/profile/adminProfile.php';
        break;
    case 'logout':
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?page=login");
        exit();

    default:
        include '../views/home.php';
        break;
}
