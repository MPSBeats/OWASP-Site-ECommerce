<?php
require_once 'database.php';
class SupportModel {
    
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    // Fonction pour créer un ticket de support
    public function createSupportTicket($userId, $subject, $message) {
        $stmt = $this->pdo->prepare("INSERT INTO Support (id_user, subject, message) VALUES (:id_user, :subject, :message)");
        return $stmt->execute([
            'id_user' => $userId,
            'subject' => $subject,
            'message' => $message
        ]);
    }
}
