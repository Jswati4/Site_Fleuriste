<?php
session_start(); // Démarre la session PHP pour stocker des variables utilisateur
require 'config.php'; // Inclut le fichier de configuration (connexion à la base de données)

// Vérifie si le formulaire a été soumis en méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère et nettoie le code promo envoyé par l'utilisateur
    $code = strtoupper(trim($_POST['code_promo']));

    // Prépare une requête SQL pour vérifier si le code promo existe et est valide (dates)
    $stmt = $conn->prepare("
        SELECT * FROM promotion 
        WHERE UPPER(code_promo) = ? 
        AND CURDATE() BETWEEN date_debut AND date_fin
    ");
    $stmt->execute([$code]); // Exécute la requête avec le code promo
    $promo = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère le résultat sous forme de tableau associatif

    // Si une promotion valide est trouvée
    if ($promo) {
        // Stocke le pourcentage de réduction et le code promo dans la session
        $_SESSION['reduction'] = (float)$promo['pourcentage_de_reduc'];
        $_SESSION['code_promo_applique'] = $promo['code_promo'];
        // Message de succès pour l'utilisateur
        $_SESSION['promo_message'] = "✅ Code promo appliqué : " . htmlspecialchars($promo['code_promo']);
    } else {
        // Supprime les variables de session si le code n'est pas valide ou expiré
        unset($_SESSION['reduction']);
        unset($_SESSION['code_promo_applique']);
        // Message d'erreur pour l'utilisateur
        $_SESSION['promo_message'] = "⛔ Code promo expiré ou non valide.";
    }

    // Redirige l'utilisateur vers la page du panier
    header("Location: panier.php");
    exit; // Termine le script après la redirection
}
