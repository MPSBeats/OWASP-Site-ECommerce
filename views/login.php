<?php
require_once '../models/userModel.php';
$user = new User();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = htmlspecialchars($_POST['mail']);
    $password = htmlspecialchars($_POST['password']);
    if (empty($password) || empty($mail)) {
        $error = 'Veuillez remplir tous les champs';
    } else {
        // Tentative de connexion de l'utilisateur
        $loggedInUser = $user->login($mail, $password);

        if ($loggedInUser) {
            $_SESSION['mail'] = $loggedInUser['mail'];
            $_SESSION['role'] = $loggedInUser['role'];
            // Redirection selon le rôle de l'utilisateur
            if ($loggedInUser['role'] === 'vendeur') {
                header("Location: index.php?page=sellerProfile");
            } elseif ($loggedInUser['role'] === 'admin') {
                header("Location: index.php?page=adminProfile");
            } else {
                header("Location: index.php?page=home");
            }
            exit();
        } else {
            $error = "mail ou mot de passe incorrect";
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
            <input type="text" name="mail" placeholder="Mail" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</main>