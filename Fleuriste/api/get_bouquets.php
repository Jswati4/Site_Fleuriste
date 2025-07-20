<?php
header('Content-Type: application/json');

   $bouquets = [
  ["id" => 1, "nom" => "Lune de Miel", "prix" => 42.00, "taille" => "L", "image" => "lune-de-miel.jpg"],
  ["id" => 2, "nom" => "Serments d'étoiles", "prix" => 22.00, "taille" => "S", "image" => "serments-etoiles.jpg"],
  ["id" => 3, "nom" => "Jardin Secret", "prix" => 65.00, "taille" => "L", "image" => "jardin-secret.jpg"],
  ["id" => 4, "nom" => "Chaleur d'été", "prix" => 80.00, "taille" => "M", "image" => "chaleur-ete.jpg"],
];

echo json_encode($bouquets);
