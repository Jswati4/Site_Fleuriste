<?php
session_start(); // Démarre la session PHP

// Vérifie si le panier existe dans la session, sinon l'initialise comme un tableau vide
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Récupère l'action envoyée par le formulaire (increase, decrease, delete)
$action = $_POST['action'] ?? '';
// Récupère l'index de l'article à modifier dans le panier
$index = $_POST['index'] ?? null;

// Vérifie que l'index est défini et que l'article existe dans le panier
if ($index !== null && isset($_SESSION['panier'][$index])) {
    switch ($action) {
        case 'increase': // Augmente la quantité de l'article
            $_SESSION['panier'][$index]['quantite']++;
            break;
        case 'decrease': // Diminue la quantité de l'article
            $_SESSION['panier'][$index]['quantite']--;
            // Si la quantité devient 0 ou négative, supprime l'article du panier
            if ($_SESSION['panier'][$index]['quantite'] <= 0) {
                unset($_SESSION['panier'][$index]);
            }
            break;
        case 'delete': // Supprime l'article du panier
            unset($_SESSION['panier'][$index]);
            break;
    }

    // Réindexe le tableau du panier pour éviter les trous dans les index
    $_SESSION['panier'] = array_values($_SESSION['panier']);
}

// Redirige l'utilisateur vers la page du panier
header("Location: panier.php");
exit;
