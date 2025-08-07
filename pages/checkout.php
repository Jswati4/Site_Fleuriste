<?php
// Démarre la session pour accéder aux variables de session
session_start();
// Récupère le panier depuis la session, ou un tableau vide si non défini
$panier = $_SESSION['panier'] ?? [];

// Si le panier est vide, redirige vers la page du panier
if (empty($panier)) {
  header('Location: panier.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Finaliser la commande</title>
  <!-- Feuilles de style pour la page -->
  <link rel="stylesheet" href="assets/style.css">
  <link rel="stylesheet" href="assets/checkout.css">
</head>
<body>

<header>
  <!-- Titre principal de la page -->
  <h1>🚚 Informations de livraison & paiement</h1>
</header>

<main>
  <!-- Formulaire de finalisation de commande -->
  <form action="confirmation.php" method="post">
    <h2>📦 Adresse de livraison</h2>
    <!-- Champ pour le nom complet -->
    <label>Nom complet :</label><br>
    <input type="text" name="nom" required><br><br>

    <!-- Champ pour l'adresse -->
    <label>Adresse :</label><br>
    <input type="text" name="adresse" required><br><br>

    <!-- Champ pour la ville -->
    <label>Ville :</label><br>
    <input type="text" name="ville" required><br><br>

    <!-- Champ pour le code postal -->
    <label>Code postal :</label><br>
    <input type="text" name="code_postal" required><br><br>

    <!-- Champ pour l'email -->
    <label>Email :</label><br>
    <input type="email" name="email" required><br><br>

    <h2>💳 Méthode de paiement</h2>
    <!-- Choix du mode de paiement : carte ou PayPal -->
    <label><input type="radio" name="paiement" value="carte" required> Carte bancaire</label><br>
    <label><input type="radio" name="paiement" value="paypal"> PayPal</label><br><br>

    <!-- Champs spécifiques à la carte bancaire -->
    <div id="carte-info">
      <label>Numéro de carte :</label><br>
      <input type="text" name="carte" maxlength="16"><br><br>

      <label>Date d'expiration :</label><br>
      <input type="text" name="expiration" placeholder="MM/AA"><br><br>

      <label>CVV :</label><br>
      <input type="text" name="cvv" maxlength="3"><br><br>
    </div>

    <!-- Bouton de confirmation et paiement -->
    <button type="submit">✅ Confirmer et payer</button>

  </form>
</main>

<script>
  // Script pour gérer l'affichage dynamique des champs de paiement
  document.addEventListener('DOMContentLoaded', () => {
    const carteInfo = document.getElementById('carte-info'); // Bloc des infos carte
    const radios = document.querySelectorAll('input[name="paiement"]'); // Radios paiement
    const form = document.querySelector('form[action="confirmation.php"]'); // Formulaire

    // Fonction pour afficher ou cacher les champs carte selon le choix
    function togglePaymentFields() {
      const method = document.querySelector('input[name="paiement"]:checked')?.value;
      carteInfo.style.display = method === 'carte' ? 'block' : 'none';
    }

    // Ajoute l'écouteur sur chaque radio pour changer l'affichage
    radios.forEach(radio => {
      radio.addEventListener('change', togglePaymentFields);
    });

    togglePaymentFields(); // Initialise l'affichage au chargement

    // Si PayPal est choisi, redirige vers le site PayPal au lieu de soumettre le formulaire
    form.addEventListener('submit', function(e) {
      const method = document.querySelector('input[name="paiement"]:checked')?.value;
      if (method === 'paypal') {
        e.preventDefault(); // Empêche l'envoi du formulaire
        window.location.href = 'https://www.paypal.com/fr/home'; // Redirige vers PayPal
      }
    });
  });
</script>

</body>
</html>
