<?php
session_start();

$bouquet = [];
$total = 0;

// Catalogue fixe pour ce test
$catalogue = [
  ["id" => "F1", "nom" => "Rose", "prix" => 2.00],
  ["id" => "F2", "nom" => "Tulipe", "prix" => 1.80],
  ["id" => "F3", "nom" => "Lys", "prix" => 2.50],
  ["id" => "F4", "nom" => "Pivoines", "prix" => 2.80],
  ["id" => "F5", "nom" => "Iris", "prix" => 1.00],
  ["id" => "F6", "nom" => "Orchidées", "prix" => 2.00]
];

// Traitement des fleurs envoyées en POST
foreach ($_POST as $id => $qte) {
  $qte = intval($qte);
  if ($qte > 0) {
    foreach ($catalogue as $fleur) {
      if ($fleur['id'] === $id) {
        $bouquet[] = [
          "id" => $fleur['id'],
          "nom" => $fleur['nom'],
          "prix" => $fleur['prix'],
          "quantite" => $qte
        ];
        $total += $qte * $fleur['prix'];
      }
    }
  }
}

// Enregistrement du bouquet dans la session
if (!isset($_SESSION['custom'])) {
  $_SESSION['custom'] = [];
}
$_SESSION['custom'][] = ["fleurs" => $bouquet, "total" => $total];

echo "Bouquet personnalisé ajouté !";
