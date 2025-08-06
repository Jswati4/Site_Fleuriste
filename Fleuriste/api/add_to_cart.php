/**
 * Ajoute un produit au panier dans la session utilisateur.
 *
 * Ce script reçoit des données JSON via une requête POST contenant les informations du produit
 * (nom, prix, image). Il vérifie la validité des données reçues, initialise le panier si nécessaire,
 * puis ajoute le produit au panier ou incrémente la quantité si le produit existe déjà.
 * 
 * Réponses JSON :
 * - Succès : { "status": "ok" }
 * - Erreur : { "status": "error", "message": "Données invalides" }
 *
 * Variables de session utilisées :
 * - $_SESSION['panier'] : tableau contenant les produits ajoutés au panier.
 *
 * Données attendues (JSON) :
 * - nom (string)   : Nom du produit
 * - prix (float)   : Prix du produit
 * - image (string) : URL de l'image du produit
 *
 * Sécurité :
 * - Utilise unset($item) après la boucle pour éviter les effets de bord.
 *
 * @author  swati
 * @version 1.0
 */
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
