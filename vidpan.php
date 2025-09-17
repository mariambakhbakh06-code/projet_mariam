<?php
session_start();
include("conn2.php");
unset($_SESSION['panier']);
header('Location: cart.php');
exit;
?>


