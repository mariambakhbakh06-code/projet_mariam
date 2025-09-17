<?php
session_start();
include("conn2.php");

// Récupération des produits depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM produits");
$stmt->execute();
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Gestion de l'ajout au panier
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
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Nos produits</h1>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])): ?>
            <div class="alert alert-success">Produit ajouté au panier !</div>
        <?php endif; ?>

        <div class="row">
            <?php foreach ($produits as $produit): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="images/<?php echo htmlspecialchars($produit['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($produit['nom']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($produit['nom']); ?></h5>
                            <p class="card-text">Prix : <?php echo htmlspecialchars($produit['prix']); ?> MAD</p>
                            <p class="card-text">Quantité disponible : <?php echo htmlspecialchars($produit['quantite']); ?></p>
                            <form action="index.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $produit['id']; ?>">
                                <input type="hidden" name="nom" value="<?php echo $produit['nom']; ?>">
                                <input type="hidden" name="prix" value="<?php echo $produit['prix']; ?>">
                                <input type="hidden" name="image" value="<?php echo $produit['image']; ?>">
                                <input type="number" name="quantite" value="1" min="1" max="<?php echo $produit['quantite']; ?>" required>
                                <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>


