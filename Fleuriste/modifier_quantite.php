<?php
session_start();

if (isset($_POST['nom'], $_POST['action']) && isset($_SESSION['panier'])) {
  foreach ($_SESSION['panier'] as &$article) {
    if ($article['nom'] === $_POST['nom']) {
      if ($_POST['action'] === 'plus') {
        $article['quantite']++;
      } elseif ($_POST['action'] === 'moins') {
        $article['quantite']--;
        if ($article['quantite'] < 1) {
          // Supprime l'article si quantité = 0
          $_SESSION['panier'] = array_filter($_SESSION['panier'], function($item) {
            return $item['quantite'] > 0;
          });
        }
      }
      break;
    }
  }
}

header('Location: panier.php');
exit;
