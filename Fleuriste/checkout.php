<?php
session_start();
$panier = $_SESSION['panier'] ?? [];

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
  <link rel="stylesheet" href="assets/style.css">
  <link rel="stylesheet" href="assets/checkout.css">
</head>
<body>

<header>
  <h1>🚚 Informations de livraison & paiement</h1>
</header>

<main>
  <form action="confirmation.php" method="post">
    <h2>📦 Adresse de livraison</h2>
    <label>Nom complet :</label><br>
    <input type="text" name="nom" required><br><br>

    <label>Adresse :</label><br>
    <input type="text" name="adresse" required><br><br>

    <label>Ville :</label><br>
    <input type="text" name="ville" required><br><br>

    <label>Code postal :</label><br>
    <input type="text" name="code_postal" required><br><br>

    <label>Email :</label><br>
    <input type="email" name="email" required><br><br>

    <h2>💳 Méthode de paiement</h2>
    <label><input type="radio" name="paiement" value="carte" required> Carte bancaire</label><br>
    <label><input type="radio" name="paiement" value="paypal"> PayPal</label><br><br>

    <div id="carte-info">
      <label>Numéro de carte :</label><br>
      <input type="text" name="carte" maxlength="16"><br><br>

      <label>Date d'expiration :</label><br>
      <input type="text" name="expiration" placeholder="MM/AA"><br><br>

      <label>CVV :</label><br>
      <input type="text" name="cvv" maxlength="3"><br><br>
    </div>

    <button type="submit">✅ Confirmer et payer</button>

  </form>
</main>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const carteInfo = document.getElementById('carte-info');
    const radios = document.querySelectorAll('input[name="paiement"]');
    const form = document.querySelector('form[action="confirmation.php"]');

    function togglePaymentFields() {
      const method = document.querySelector('input[name="paiement"]:checked')?.value;
      carteInfo.style.display = method === 'carte' ? 'block' : 'none';
    }

    // Applique l'affichage dynamique au changement de méthode de paiement
    radios.forEach(radio => {
      radio.addEventListener('change', togglePaymentFields);
    });

    togglePaymentFields(); // Initialiser au chargement

    // Gestion de la redirection si PayPal est choisi
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
