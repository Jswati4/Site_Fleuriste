<?php
session_start(); // Démarre la session pour accéder à $_SESSION

// Vérifie que les données nécessaires sont envoyées et que le panier existe
if (isset($_POST['nom'], $_POST['action']) && isset($_SESSION['panier'])) {
  $nom = $_POST['nom']; // Récupère le nom de l'article
  $action = $_POST['action']; // Récupère l'action à effectuer

  // Parcourt chaque article du panier
  foreach ($_SESSION['panier'] as $index => &$article) {
    // Vérifie si l'article correspond au nom envoyé
    if ($article['nom'] === $nom) {
      // Si l'action est "plus", augmente la quantité
      if ($action === 'plus') {
        $article['quantite']++;
      // Si l'action est "moins", diminue la quantité
      } elseif ($action === 'moins') {
        $article['quantite']--;
        // Si la quantité devient inférieure à 1, supprime l'article du panier
        if ($article['quantite'] < 1) {
          unset($_SESSION['panier'][$index]);
        }
      // Si l'action est "supprimer", retire l'article du panier
      } elseif ($action === 'supprimer') {
        unset($_SESSION['panier'][$index]);
      }
      break; // Sort de la boucle après modification
    }
  }

  // Réindexe le tableau du panier pour éviter les trous dans les indices
  $_SESSION['panier'] = array_values($_SESSION['panier']);
}

// Redirige vers la page du panier après modification
header('Location: panier');
exit;
