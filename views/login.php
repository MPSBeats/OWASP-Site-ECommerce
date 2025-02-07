<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../models/userModel.php';
$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nettoyage des données entrées par l'utilisateur
    $mail = filter_var(trim($_POST['mail']), FILTER_SANITIZE_EMAIL); // Valider et nettoyer l'email
    $password = trim($_POST['password']); // Nettoyer le mot de passe

    if (empty($password) || empty($mail)) {
        $error = 'Veuillez remplir tous les champs';
    } else {
        // Tentative de connexion de l'utilisateur
        $loggedInUser = $user->login($mail, $password);

        if ($loggedInUser) {
            // Connexion réussie, stocker les informations de l'utilisateur dans la session
            $_SESSION['mail'] = $loggedInUser['mail'];
            $_SESSION['role'] = $loggedInUser['role'];
            $_SESSION['user_id'] = $loggedInUser['id_user'];

            // Redirection selon le rôle de l'utilisateur
            if ($loggedInUser['role'] === 'vendeur') {
                header("Location: index.php?page=sellerProfile");
            } elseif ($loggedInUser['role'] === 'admin') {
                header("Location: index.php?page=adminProfile");
            } else {
                header("Location: index.php?page=products");
            }
            exit();
        } else {
            $error = "Mail ou mot de passe incorrect";
        }
    }
}
?>

<main class="login">
    <div class="space"></div>
    <h1>Connexion :</h1>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <div class="container">
        <form action="index.php?page=login" method="post">
            <input type="email" name="mail" placeholder="Mail" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</main>
