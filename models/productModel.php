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

    public function getProductByID($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM products WHERE id_product = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    public function getProductsBySeller($seller_id)
{
    $stmt = $this->pdo->prepare('SELECT * FROM products WHERE id_user = :seller_id');
    $stmt->execute(['seller_id' => $seller_id]);
    return $stmt->fetchAll();
}

}