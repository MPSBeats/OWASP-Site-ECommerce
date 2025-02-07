<?php
require_once '../models/database.php';
require_once '../models/sellerModel.php';

$sellerModel = new Seller();
$sellers = $sellerModel->getSellers();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des vendeurs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Liste des vendeurs</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
            </tr>
        </thead>
<tbody>
    <?php foreach ($sellers as $seller): ?>
        <tr>
            <td><?= htmlspecialchars($seller['id']) ?></td>
            <td>
    <a href="index.php?page=sellerProducts&id=<?= htmlspecialchars($seller['id']) ?>">
        <?= htmlspecialchars($seller['name']) ?>
    </a>
</td>
            <td><?= htmlspecialchars($seller['email']) ?></td>
        </tr>
    <?php endforeach; ?>
</tbody>

    </table>
</body>
</html>