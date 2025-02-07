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

    public function login($mail, $password)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE mail= :mail');
        $stmt->execute(['mail' => $mail]);
        $user = $stmt->fetch();

        if ($user && password_verify($mail, $user['password'])) {
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
