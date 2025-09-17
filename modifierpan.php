<?php
session_start();
include("conn2.php");

if (isset($_POST['id']) && isset($_POST['quantite'])) {
    $id = $_POST['id'];
    $quantite = $_POST['quantite'];


    foreach ($_SESSION['panier'] as &$article) {
        if ($article['id'] == $id ){
            $article['quantite'] = $quantite;
            break;
        }
    }
}

header('Location: cart.php');
exit;
?>
