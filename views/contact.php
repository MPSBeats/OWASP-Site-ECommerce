<?php
// Démarre la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inclure la connexion à la base de données et le modèle de Support
require_once "../models/database.php";
require_once "../models/supportModel.php";

$supportModel = new SupportModel();

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    } else {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        header("Location: index.php?page=login");
        exit();
    }

    // Récupérer les données du formulaire en les sécurisant
    $subject = isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '';
    $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

    // Vérifier que les champs sont bien remplis
    if (!empty($subject) && !empty($message)) {
        // Ajouter le ticket de support à la base de données
        if ($supportModel->createSupportTicket($userId, $subject, $message)) {
            $successMessage = "Votre message a été envoyé avec succès.";
        } else {
            $errorMessage = "Une erreur est survenue. Veuillez réessayer.";
        }
    } else {
        $errorMessage = "Tous les champs sont obligatoires.";
    }
}
?>

<main>
    <h1>Contactez-nous</h1>

    <!-- Formulaire de contact -->
    <form action="index.php?page=contact" method="post">
        <div>
            <label for="subject">Objet</label>
            <input type="text" name="subject" id="subject" required>
        </div>
        <div>
            <label for="message">Message</label>
            <textarea name="message" id="message" required></textarea>
        </div>
        <div>
            <button type="submit">Envoyer</button>
        </div>
    </form>

    <!-- Affichage des messages de succès ou d'erreur -->
    <?php
    if (isset($successMessage)) {
        echo "<p style='color: green;'>$successMessage</p>";
    }

    if (isset($errorMessage)) {
        echo "<p style='color: red;'>$errorMessage</p>";
    }
    ?>
</main>
