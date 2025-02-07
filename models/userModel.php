<?php

require_once 'Database.php';
class User
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    // public function register($password, $firstname, $lastname, $mail,)
    // {
    //     $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    //     $stmt = $this->pdo->prepare('INSERT INTO users ( pseudo, password, firstname, lastname,  mail) VALUES  (:pseudo, :password,:firstname,:lastname, :birth, :country, :mail,:phone,  :picture)');

    //     return $stmt->execute([
    //         'password' => $hashed_password,
    //         'firstname' => $firstname,
    //         'lastname' => $lastname,
    //         'mail' => $mail,
    //     ]);
    // }

    public function login($pseudo, $password)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE pseudo= :pseudo');
        $stmt->execute(['pseudo' => $pseudo]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getUserId($pseudo)
    {
        $stmt = $this->pdo->prepare('SELECT id_user FROM users WHERE pseudo= :pseudo');
        $stmt->execute(['pseudo' => $pseudo]);
        return $stmt->fetchColumn();
    }

}
