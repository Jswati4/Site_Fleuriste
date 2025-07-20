<?php
session_start();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

$action = $_POST['action'] ?? '';
$index = $_POST['index'] ?? null;

if ($index !== null && isset($_SESSION['panier'][$index])) {
    switch ($action) {
        case 'increase':
            $_SESSION['panier'][$index]['quantite']++;
            break;
        case 'decrease':
            $_SESSION['panier'][$index]['quantite']--;
            if ($_SESSION['panier'][$index]['quantite'] <= 0) {
                unset($_SESSION['panier'][$index]);
            }
            break;
        case 'delete':
            unset($_SESSION['panier'][$index]);
            break;
    }

    // Réindexer proprement
    $_SESSION['panier'] = array_values($_SESSION['panier']);
}

header("Location: panier.php");
exit;
