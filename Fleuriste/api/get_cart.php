<?php
session_start(); // Démarre la session PHP
header('Content-Type: application/json'); // Définit le type de contenu de la réponse en JSON

// Bouquets prédéfinis
$catalogue = [
  ["id" => 1, "nom" => "Lune de Miel", "prix" => 42.00, "taille" => "L", "image" => "lune-de-miel.jpg"],
  ["id" => 2, "nom" => "Serments d'étoiles", "prix" => 22.00, "taille" => "S", "image" => "serments-d'étoiles.jpg"],
  ["id" => 3, "nom" => "Jardin Secret", "prix" => 65.00, "taille" => "L", "image" => "jardin-secret.jpg"],
  ["id" => 4, "nom" => "Chaleur d'été", "prix" => 80.00, "taille" => "M", "image" => "chaleur-d'été.jpg"],
];

// Traitement du panier prédéfini
$panier = $_SESSION['panier'] ?? []; // Récupère le panier depuis la session, ou tableau vide si non défini
$resultat = array_count_values($panier); // Compte le nombre d'occurrences de chaque bouquet dans le panier

$items = []; // Tableau qui contiendra les éléments du panier
foreach ($resultat as $id => $quantite) {
  // Vérifie si l'ID existe dans le catalogue
  if (isset($catalogue[$id])) {
    $item = $catalogue[$id]; // Récupère les infos du bouquet
    $items[] = [
      "nom" => $item['nom'], // Nom du bouquet
      "quantite" => $quantite, // Quantité dans le panier
      "total" => $quantite * $item['prix'] // Prix total pour ce bouquet
    ];
  }
}

// Traitement du bouquet personnalisé
$customs = $_SESSION['custom'] ?? []; // Récupère les bouquets personnalisés depuis la session
foreach ($customs as $index => $bouquet) {
  $nom = "Bouquet personnalisé #" . ($index + 1); // Nom du bouquet personnalisé
  $total = $bouquet['total']; // Prix total du bouquet personnalisé

  $fleursListe = []; // Liste des fleurs du bouquet personnalisé
  foreach ($bouquet['fleurs'] as $f) {
    $fleursListe[] = "{$f['quantite']}x {$f['nom']}"; // Ajoute la quantité et le nom de chaque fleur
  }

  $items[] = [
    "nom" => $nom . " (" . implode(", ", $fleursListe) . ")", // Nom + liste des fleurs
    "quantite" => 1, // Un seul bouquet personnalisé à chaque fois
    "total" => $total // Prix total
  ];
}

echo json_encode($items); // Renvoie le panier au format JSON

// Requêtes SQL (non utilisées dans ce script)
// $sql = "SELECT * FROM Client WHERE email = '$email'";

// Préparation et exécution d'une requête SQL (non utilisée ici)
// $stmt = $pdo->prepare("SELECT * FROM Client WHERE email = ?");
// $stmt->execute([$email]);
