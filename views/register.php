<?php
require_once '../models/userModel.php';
$user = new User();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = htmlspecialchars($_POST['password']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $mail = htmlspecialchars($_POST['mail']);
    $role = htmlspecialchars($_POST['role']);

    if (empty($password) || empty($firstname) || empty($lastname) || empty($mail) || empty($role)) {
        $error = 'Veuillez remplir tous les champs';
    } elseif (!preg_match('/^(?!.*@.*@)(?!.*\..*\..*)[a-zA-Z0-9._%+-]{1,64}@[a-zA-Z0-9.-]{1,15}\.[a-zA-Z]{2,10}$/i', $mail)) {
        $error = 'Adresse e-mail invalide';
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/', $password)) {
        $error = 'Le mot de passe doit contenir une majuscule, une minuscule, un chiffre et un caractère spécial.';
    } elseif (!preg_match("/^[a-zA-Z'\\-]{1,50}$/", $firstname)) {
        $error = 'Le prénom ne peut contenir que des lettres, des tirets et des apostrophes, et doit être inférieur à 50 caractères.';
    } elseif (!preg_match("/^[a-zA-Z'\\-]{1,50}$/", $lastname)) {
        $error = 'Le nom ne peut contenir que des lettres, des tirets et des apostrophes, et doit être inférieur à 50 caractères.';
    } else {
        $registered = $user->register($password, $firstname, $lastname, $mail, $role);

        if ($registered) {
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
