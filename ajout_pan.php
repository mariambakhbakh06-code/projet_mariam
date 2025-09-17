<?php
session_start();

// Vérifier si le panier existe, sinon le créer
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Ajouter un produit au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['quantite'])) {
    $id = $_POST['id'];
    $quantite = $_POST['quantite'];

    // Vérifier si le produit est déjà dans le panier
    if (isset($_SESSION['panier'][$id])) {
        // Ajouter la quantité au produit existant
        $_SESSION['panier'][$id]['quantite'] += $quantite;
    } else {
        // Ajouter le produit au panier
        $_SESSION['panier'][$id] = [
            'nom' => $_POST['nom'],
            'prix' => $_POST['prix'],
            'image' => $_POST['image'],
            'quantite' => $quantite
        ];
    }

    // Redirection pour éviter la soumission multiple du formulaire
    header("Location: ajout_pan.php");
    exit;
}

// Supprimer un produit du panier
if (isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];
    unset($_SESSION['panier'][$id]);
    header("Location: ajout_pan.php");
    exit;
}

// Modifier la quantité d'un produit dans le panier
if (isset($_POST['modifier'])) {
    foreach ($_POST['quantite'] as $id => $quantite) {
        $_SESSION['panier'][$id]['quantite'] = $quantite;
    }
    header("Location: ajout_pan.php");
    exit;
}

// Calculer le total du panier
$total = 0;
foreach ($_SESSION['panier'] as $produit) {
    $total += $produit['prix'] * $produit['quantite'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Mon Panier</h1>

        <?php if (empty($_SESSION['panier'])): ?>
            <p>Votre panier est vide.</p>
        <?php else: ?>
            <form action="ajout_pan.php" method="POST">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['panier'] as $id => $produit): ?>
                            <tr>
                                <td>
                                    <img src="images/<?php echo htmlspecialchars($produit['image']); ?>" alt="<?php echo htmlspecialchars($produit['nom']); ?>" width="50">
                                    <?php echo htmlspecialchars($produit['nom']); ?>
                                </td>
                                <td><?php echo number_format($produit['prix'], 2, ',', ' '); ?> MAD</td>
                                <td>
                                    <input type="number" name="quantite[<?php echo $id; ?>]" value="<?php echo $produit['quantite']; ?>" min="1" max="99" required>
                                </td>
                                <td><?php echo number_format($produit['prix'] * $produit['quantite'], 2, ',', ' '); ?> MAD</td>
                                <td>
                                    <a href="supp.php?supprimer=<?php echo $id; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" name="modifier" class="btn btn-warning">Mettre à jour le panier</button>
            </form>

            <div class="mt-3">
                <h4>Total : <?php echo number_format($total, 2, ',', ' '); ?> MAD</h4>
                <a href="index.php" class="btn btn-secondary">Continuer vos achats</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>




