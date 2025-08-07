<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleuriste</title>
    <link rel="stylesheet" href="assets/style.css">

</head>
<body>
    <?php
    $uri = $_SERVER['REQUEST_URI'];
    switch ($uri) {
        case '/':
        case '/home':
            include './pages/home.php';
            break;
        case '/a_propos':
            include 'pages/a_propos.php';
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
        default:
            http_response_code(404);
            echo "<h1>404 Not Found</h1>";
            echo "<p>The page you are looking for does not exist.</p>";
            break;
    }
    ?>
</body>
</html>