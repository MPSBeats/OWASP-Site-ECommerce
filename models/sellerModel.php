<?php
require_once 'database.php';

class Seller
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    public function getSellers()
    {
        $stmt = $this->pdo->prepare("SELECT id_user AS id, CONCAT(firstname, ' ', lastname) AS name, mail AS email FROM users WHERE role = 'vendeur'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getSellerById($id)
    {
        $stmt = $this->pdo->prepare("SELECT id_user AS id, CONCAT(firstname, ' ', lastname) AS name, mail AS email FROM users WHERE id_user = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}