<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Traitement du paiement (à implémenter selon le système de paiement choisi)
    unset($_SESSION['panier']);
    header('Location: confirmation.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passer à la Caisse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Passer à la Caisse</h2>
        <form action="checkout.php" method="POST">
            <div class="form-group">
                <label for="nom">Nom</label>
 
