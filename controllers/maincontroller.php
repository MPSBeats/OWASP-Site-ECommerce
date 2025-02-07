<?php

$page = (isset($_GET['page'])) ? $_GET['page'] : 'home';
$user = (isset($_GET['user'])) ? $_GET['user'] : '';


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
        include '../views/products.php';
        break;
    
    case 'seller':
        include '../views/seller.php';
        break;

    default:
        include '../views/home.php';
        break;
}
