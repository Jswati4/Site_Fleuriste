<?php
session_start();
header('Content-Type: application/json');

// Initialiser le panier s'il est vide ou mal formé
if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Récupération des données JSON
$data = json_decode(file_get_contents("php://input"), true);

// Vérification des données essentielles
if (!$data || !isset($data['nom'], $data['prix'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Données invalides']);
    exit;
}

// Quantité minimale 1
$quantite = (isset($data['quantite']) && is_numeric($data['quantite']) && $data['quantite'] > 0)
    ? intval($data['quantite']) : 1;

// Vérifier si le produit existe déjà (par nom uniquement ou critères personnalisés si besoin)
$existe = false;
foreach ($_SESSION['panier'] as &$item) {
    if (is_array($item) && isset($item['nom']) && $item['nom'] === $data['nom']) {
        $item['quantite'] += $quantite;
        $existe = true;
        break;
    }
}
unset($item);

// Si le produit n'existe pas encore, on le prépare et l'ajoute
if (!$existe) {
    $item = [
        'nom' => $data['nom'],
        'prix' => floatval($data['prix']),
        'quantite' => $quantite,
        'image' => isset($data['image']) ? $data['image'] : 'default.jpg'
    ];

    // Champs facultatifs, ajoutés uniquement s'ils existent
    $champs_optionnels = [
        'forme', 'fleurs', 'couleurs', 'feuillages',
        'messageChoix', 'typeMessage', 'texteMessage', 'budget', 'taille'
    ];

    foreach ($champs_optionnels as $champ) {
        if (isset($data[$champ])) {
            $item[$champ] = $data[$champ];
        }
    }

    $_SESSION['panier'][] = $item;
}

// Nettoyage facultatif : filtrer les éléments corrompus
$_SESSION['panier'] = array_filter($_SESSION['panier'], function ($article) {
    return is_array($article) && isset($article['nom'], $article['prix'], $article['quantite']);
});

echo json_encode(['status' => 'ok', 'message' => 'Produit ajouté au panier']);
?>