<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = strtoupper(trim($_POST['code_promo']));

    // Préparation de la requête pour récupérer une promo valide
    $stmt = $conn->prepare("
        SELECT * FROM promotion 
        WHERE UPPER(code_promo) = ? 
        AND CURDATE() BETWEEN date_debut AND date_fin
    ");
    $stmt->execute([$code]);
    $promo = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si une promo valide est trouvée
    if ($promo) {
        $_SESSION['reduction'] = (float)$promo['pourcentage_de_reduc'];
        $_SESSION['code_promo_applique'] = $promo['code_promo'];
        $_SESSION['promo_message'] = "✅ Code promo appliqué : " . htmlspecialchars($promo['code_promo']);
    } else {
        unset($_SESSION['reduction']);
        unset($_SESSION['code_promo_applique']);
        $_SESSION['promo_message'] = "⛔ Code promo expiré ou non valide.";
    }

    header("Location: panier.php");
    exit;
}
