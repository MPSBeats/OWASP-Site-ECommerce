<?php
require_once '../models/userModel.php';
$user = new User();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = htmlspecialchars($_POST['password']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $mail = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
    $role = htmlspecialchars($_POST['role']);

    if (empty($password) || empty($firstname) || empty($lastname) || empty($mail) || empty($role)) {
        $error = 'Veuillez remplir tous les champs';
    } elseif (!$mail) {
        $error = 'Adresse e-mail invalide';
    } else {
        // Tentative d'inscription de l'utilisateur
        $registered = $user->register($password, $firstname, $lastname, $mail, $role);

        if ($registered) {
            // Inscription réussie, redirection vers la page de connexion
            header("Location: index.php?page=login");
            exit();
        } else {
            $error = "Erreur lors de l'inscription. Essayez un autre e-mail.";
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
            <input type="email" name="mail" placeholder="E-mail" required>
            <input type="text" name="firstname" placeholder="Prénom" required>
            <input type="text" name="lastname" placeholder="Nom" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <select id="role" name="role" required>
                <option value="client">Client</option>
                <option value="vendeur">Vendeur</option>
            </select>
            <button type="submit">S'inscrire</button>
            <a href="index.php?page=login">Déjà inscrit ?</a>
        </form>
    </div>
</main>