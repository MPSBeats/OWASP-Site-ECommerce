<?php

require_once '../models/userModel.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $mail = htmlspecialchars($_POST['mail']);
    $password = htmlspecialchars($_POST['password']);

    // Vérification des champs vides
    if (empty($password) || empty($mail)) {
        $error = 'Veuillez remplir tous les champs';
    } else {
        // Tentative de connexion de l'utilisateur
        $loggedInUser = $user->login($mail, $password);

        if ($loggedInUser) {
            // Connexion réussie, redirection vers la page de profil
            $_SESSION['mail'] = $loggedInUser['mail'];

            header("Location: index.php?page=profile");
            exit();
        } else {
            // Connexion échouée, message d'erreur
            $error = "mail ou mot de passe incorrect";
        }
    }
}
?>

<main class="login">
    <div class="space"></div>
    <h1>Connexion :</h1>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p> <!-- Affichage du message d'erreur -->
    <?php endif; ?>
    <div class="container">
        <form action="index.php?page=login" method="post">
            <input type="text" name="mail" placeholder="mail" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</main>