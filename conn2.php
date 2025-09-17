<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=projetdb;port=33006", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie";
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


