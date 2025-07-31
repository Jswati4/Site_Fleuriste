<?php
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['nom'], $data['prix'], $data['image'])) {
  http_response_code(400);
  echo json_encode(['status' => 'error', 'message' => 'Données invalides']);
  exit;
}

// Initialiser le panier
if (!isset($_SESSION['panier'])) {
  $_SESSION['panier'] = [];
}

// Vérifier si le produit existe déjà dans le panier
$existe = false;
foreach ($_SESSION['panier'] as &$item) {
  if ($item['nom'] === $data['nom']) {
    $item['quantite'] += 1;
    $existe = true;
    break;
  }
}
unset($item); // sécurité

if (!$existe) {
  $_SESSION['panier'][] = [
    'nom' => $data['nom'],
    'prix' => $data['prix'],
    'image' => $data['image'],
    'quantite' => 1
  ];
}

echo json_encode(['status' => 'ok']);
