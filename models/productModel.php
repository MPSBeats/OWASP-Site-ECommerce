<?php

require_once 'Database.php';

class Product{

    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    public function getProducts()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM products');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getProductById($id) {
        $stmt = $this->pdo->prepare('SELECT p.id_product, p.name, p.description, p.price, p.image_url, u.firstname AS seller_name
            FROM products p LEFT JOIN users u ON u.id_user = p.id_vendeur WHERE p.id_product = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un tableau associatif
    }
    

}