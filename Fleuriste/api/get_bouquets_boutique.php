<?php
// Définit le type de contenu de la réponse HTTP comme JSON
header('Content-Type: application/json');

// Tableau contenant les informations des bouquets disponibles en boutique
$bouquets = [
  // Chaque bouquet est représenté par un tableau associatif avec ses propriétés
  ["id" => 1, "nom" => "Clarté d'Aube", "prix" => 28, "taille" => "S", "image" => "clarte-aube.jpg", "description" => "Douceur matinale aux tons poudrés"],
  ["id" => 2, "nom" => "Nuage Lavande", "prix" => 40, "taille" => "S", "image" => "nuage-lavande.jpg", "description" => "Élégance violette et parfum délicat"],
  ["id" => 3, "nom" => "Rosée Bohème", "prix" => 70, "taille" => "L", "image" => "rosee-boheme.jpg", "description" => "Création libre aux accents sauvages"],
  ["id" => 4, "nom" => "Lune d'été", "prix" => 53, "taille" => "M", "image" => "lune-ete.jpg", "description" => "Fraîcheur estivale et lumière dorée"],
  ["id" => 5, "nom" => "Brume de Lin", "prix" => 38, "taille" => "M", "image" => "brume-de-lin.jpg", "description" => "Naturel et authentique, tons neutres"],
  ["id" => 6, "nom" => "Silence Bleu", "prix" => 42, "taille" => "M", "image" => "silence-bleu.jpg", "description" => "Sérénité azurée et calme apaisant"],
  ["id" => 7, "nom" => "Éclat de Rose", "prix" => 65, "taille" => "L", "image" => "eclats-de-rose.jpg", "description" => "Romance intense aux nuances rosées"],
  ["id" => 8, "nom" => "Éveil Sauvage", "prix" => 85, "taille" => "L", "image" => "eveil-sauvage.jpg", "description" => "Puissance naturelle et caractère affirmé"]
];

// Encode le tableau $bouquets en format JSON et l'affiche
echo json_encode($bouquets);
?>