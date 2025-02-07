<?php

require_once 'database.php';
class User
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    public function register($password, $firstname, $lastname, $mail, $role)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO users (password, firstname, lastname, mail, role) VALUES (:password, :firstname, :lastname, :mail, :role)');
        return $stmt->execute([
            'password' => $hashed_password,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'mail' => $mail,
            'role' => $role,
        ]);
    }

    public function login($mail, $password)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE mail= :mail');
        $stmt->execute(['mail' => $mail]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getUserId($mail)
    {
        $stmt = $this->pdo->prepare('SELECT id_user FROM users WHERE mail= :mail');
        $stmt->execute(['mail' => $mail]);
        return $stmt->fetchColumn();
    }

}
