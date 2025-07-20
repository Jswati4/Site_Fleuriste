<?php
session_start();
header('Content-Type: application/json');

// Bouquets prédéfinis
$catalogue = [
  ["id" => 1, "nom" => "Lune de Miel", "prix" => 42.00, "taille" => "L", "image" => "lune-de-miel.jpg"],
  ["id" => 2, "nom" => "Serments d'étoiles", "prix" => 22.00, "taille" => "S", "image" => "serments-d'étoiles.jpg"],
  ["id" => 3, "nom" => "Jardin Secret", "prix" => 65.00, "taille" => "L", "image" => "jardin-secret.jpg"],
  ["id" => 4, "nom" => "Chaleur d'été", "prix" => 80.00, "taille" => "M", "image" => "chaleur-d'été.jpg"],
];

// Traitement du panier prédéfini
$panier = $_SESSION['panier'] ?? [];
$resultat = array_count_values($panier);

$items = [];
foreach ($resultat as $id => $quantite) {
  if (isset($catalogue[$id])) {
    $item = $catalogue[$id];
    $items[] = [
      "nom" => $item['nom'],
      "quantite" => $quantite,
      "total" => $quantite * $item['prix']
    ];
  }
}

// Traitement du bouquet personnalisé
$customs = $_SESSION['custom'] ?? [];
foreach ($customs as $index => $bouquet) {
  $nom = "Bouquet personnalisé #" . ($index + 1);
  $total = $bouquet['total'];

  $fleursListe = [];
  foreach ($bouquet['fleurs'] as $f) {
    $fleursListe[] = "{$f['quantite']}x {$f['nom']}";
  }

  $items[] = [
    "nom" => $nom . " (" . implode(", ", $fleursListe) . ")",
    "quantite" => 1,
    "total" => $total
  ];
}

echo json_encode($items);
