<?php
header('Content-Type: application/json');

// Simulation de fleurs disponibles (remplacez par votre base de données)
$fleurs = [
    ['id' => 1, 'nom' => 'Rose rouge', 'prix' => 3.50],
    ['id' => 2, 'nom' => 'Rose blanche', 'prix' => 3.50],
    ['id' => 3, 'nom' => 'Rose rose', 'prix' => 3.50],
    ['id' => 4, 'nom' => 'Tulipe rouge', 'prix' => 2.80],
    ['id' => 5, 'nom' => 'Tulipe jaune', 'prix' => 2.80],
    ['id' => 6, 'nom' => 'Pivoine', 'prix' => 5.00],
    ['id' => 7, 'nom' => 'Iris bleu', 'prix' => 4.20],
    ['id' => 8, 'nom' => 'Lys blanc', 'prix' => 4.80],
    ['id' => 9, 'nom' => 'Orchidée', 'prix' => 6.50],
    ['id' => 10, 'nom' => 'Gypsophile', 'prix' => 1.50],
    ['id' => 11, 'nom' => 'Eucalyptus', 'prix' => 2.00],
    ['id' => 12, 'nom' => 'Fougère', 'prix' => 1.80]
];

echo json_encode($fleurs);
?>