<?php
// Démarre la session pour toutes les pages
session_start();

// Récupère l'URI demandée, sans les éventuels paramètres GET
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Normalise l'URL (supprime le slash final sauf pour la racine)
if ($uri !== '/' && str_ends_with($uri, '/')) {
    $uri = rtrim($uri, '/');
}

// Définition des routes disponibles
switch ($uri) {
    case '/':
    case '/home':
        include './pages/home.php';
        break;

    case '/a_propos':
        include './pages/a_propos.php';
        break;

    case '/boutique':
        include './pages/boutique.php';
        break;

    case '/composer':
        include './pages/composer.php';
        break;

    case '/compte':
        include './pages/compte.php';
        break;

    case '/inscription':
        include './pages/inscription.php';
        break;

    case '/panier':
        include './pages/panier.php';
        break;

    case '/modifier_panier':
        include './pages/modifier_panier.php';
        break;

    case '/modifier_quantite':
        include './pages/modifier_quantite.php';
        break;

    case '/checkout':
        include './pages/checkout.php';
        break;

    case '/confirmation':
        include './pages/confirmation.php';
        break;

    case '/contact':
        include './pages/contact.php';
        break;

    case '/send_contact':
        include './pages/send_contact.php';
        break;

    case '/newsletter':
        include './pages/newsletter.php';
        break;

    case '/newsletter_send':
        include './pages/newsletter_send.php';
        break;

    case '/appliquer_promo':
        include './pages/appliquer_promo.php';
        break;

    default:
        http_response_code(404);
        echo "<h1>404 - Page non trouvée</h1>";
        echo "<p>La page que vous cherchez n'existe pas.</p>";
        break;
}
?>
