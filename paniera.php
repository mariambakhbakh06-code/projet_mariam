<?php
session_start();
include("conn2.php");

if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    echo "<p>Votre panier est vide.</p>";
    exit;
}

$id = array_keys($_SESSION['panier']);
$placeholders = implode(',', array_fill(0, count($id), '?'));
$stmt = $pdo->prepare("SELECT * FROM produits WHERE id IN ($placeholders)");
$stmt->execute($id);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Votre panier</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produits as $produit): ?>
                    <?php
                    $quantite = $_SESSION['panier'][$produit['id']]['quantite'];
                    $totalProduit = $produit['prix'] * $quantite;
                    $total += $totalProduit;
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($produit['nom']); ?></td>
                        <td><?php echo htmlspecialchars($produit['prix']); ?> MAD</td>
                        <td><?php echo $quantite; ?></td>
                        <td><?php echo $totalProduit; ?> MAD</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3>Total : <?php echo $total; ?> MAD</h3>
        <a href="index.php" class="btn btn-secondary">Retour à la boutique</a>
    </div>
</body>
</html>



