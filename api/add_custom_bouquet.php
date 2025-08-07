<?php
session_start(); // Démarre la session PHP pour stocker les données utilisateur

$bouquet = []; // Tableau pour stocker les fleurs du bouquet personnalisé
$total = 0;    // Variable pour calculer le prix total du bouquet

// Catalogue fixe pour ce test : liste des fleurs disponibles avec leur prix
$catalogue = [
  ["id" => "F1", "nom" => "Rose", "prix" => 2.00],
  ["id" => "F2", "nom" => "Tulipe", "prix" => 1.80],
  ["id" => "F3", "nom" => "Lys", "prix" => 2.50],
  ["id" => "F4", "nom" => "Pivoines", "prix" => 2.80],
  ["id" => "F5", "nom" => "Iris", "prix" => 1.00],
  ["id" => "F6", "nom" => "Orchidées", "prix" => 2.00]
];

// Traitement des fleurs envoyées en POST
foreach ($_POST as $id => $qte) { // Parcourt chaque fleur envoyée via le formulaire
  $qte = intval($qte); // Convertit la quantité en entier
  if ($qte > 0) { // Vérifie que la quantité est positive
    foreach ($catalogue as $fleur) { // Recherche la fleur dans le catalogue
      if ($fleur['id'] === $id) { // Si l'ID correspond
        $bouquet[] = [
          "id" => $fleur['id'],         // Ajoute l'ID de la fleur
          "nom" => $fleur['nom'],       // Ajoute le nom de la fleur
          "prix" => $fleur['prix'],     // Ajoute le prix unitaire
          "quantite" => $qte            // Ajoute la quantité choisie
        ];
        $total += $qte * $fleur['prix']; // Ajoute au total le prix de cette fleur
      }
    }
  }
}

// Enregistrement du bouquet dans la session
if (!isset($_SESSION['custom'])) { // Si le tableau 'custom' n'existe pas dans la session
  $_SESSION['custom'] = [];        // On le crée
}
$_SESSION['custom'][] = ["fleurs" => $bouquet, "total" => $total]; // Ajoute le bouquet et son total dans la session

echo "Bouquet personnalisé ajouté !"; // Message de confirmation
