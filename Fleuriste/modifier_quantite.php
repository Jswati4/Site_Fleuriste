<?php
session_start();

if (isset($_POST['nom'], $_POST['action']) && isset($_SESSION['panier'])) {
  $nom = $_POST['nom'];
  $action = $_POST['action'];

  foreach ($_SESSION['panier'] as $index => &$article) {
    if ($article['nom'] === $nom) {
      if ($action === 'plus') {
        $article['quantite']++;
      } elseif ($action === 'moins') {
        $article['quantite']--;
        if ($article['quantite'] < 1) {
          unset($_SESSION['panier'][$index]);
        }
      } elseif ($action === 'supprimer') {
        unset($_SESSION['panier'][$index]);
      }
      break;
    }
  }

  // Réindexe le tableau après suppressions
  $_SESSION['panier'] = array_values($_SESSION['panier']);
}

header('Location: panier.php');
exit;
