<?php
require_once '../models/userModel.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $mail = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
    if (empty($pseudo) || empty($password) || empty($firstname) || empty($lastname) || empty($mail)) {
        $error = 'Veuillez remplir tous les champs';
    } elseif (!$mail) {
        $error = 'Adresse e-mail invalide';
    } else {
        // Tentative d'inscription de l'utilisateur
        $registered = $user->register($pseudo, $password, $firstname, $lastname, $mail);

        if ($registered) {
            // Inscription réussie, redirection vers la connexion
            header("Location: index.php?page=login");
            exit();
        } else {
            // Inscription échouée, message d'erreur
            $error = "Erreur lors de l'inscription. Essayez un autre pseudo ou e-mail.";
        }
    }
}
?>

<main class="register">
    <div class="space"></div>
    <h1>Inscription :</h1>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <div class="container">
        <form action="index.php?page=register" method="post">
            <input type="text" name="pseudo" placeholder="Pseudo" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="text" name="firstname" placeholder="Prénom" required>
            <input type="text" name="lastname" placeholder="Nom" required>
            <input type="email" name="mail" placeholder="E-mail" required>
            <button type="submit">S'inscrire</button>
        </form>
    </div>
</main>