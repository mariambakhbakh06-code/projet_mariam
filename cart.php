<?php
session_start();
include("conn2.php");
if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    echo "<p>Votre panier est vide.</p>";
} else {
    echo "<table class='table'>";
    echo "<tr><th>Produit</th><th>Prix</th><th>Quantité</th><th>Total</th><th>Action</th></tr>";
    
    $totalPanier = 0;
    
    foreach ($_SESSION['panier'] as $id => $produit) {
        $nom = isset($produit['nom']) ? htmlspecialchars($produit['nom']) : "Nom inconnu";
        $prix = isset($produit['prix']) ? htmlspecialchars($produit['prix']) : 0;
        $quantite = isset($produit['quantite']) ? intval($produit['quantite']) : 1;
        $total = $prix * $quantite;

        $totalPanier += $total;

        echo "<tr>
                <td>{$nom}</td>
                <td>{$prix} MAD</td>
                <td>{$quantite}</td>
                <td>{$total} MAD</td>
                <td>
                    <form action='modifierpan.php' method='POST'>
                        <input type='hidden' name='id' value='{$id}'>
                        <input type='number' name='quantite' value='{$quantite}' min='1' required>
                        <button type='submit' class='btn btn-warning btn-sm'>Modifier</button>
                    </form>
                    <a href='supp.php?id={$id}' class='btn btn-danger btn-sm'>Supprimer</a>
                </td>
              </tr>";
    }
    
    echo "<tr><td colspan='3'><strong>Total:</strong></td><td><strong>{$totalPanier} MAD</strong></td></tr>";
    echo "</table>";
}
?>



