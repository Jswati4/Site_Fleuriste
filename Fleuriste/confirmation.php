<?php
session_start();

$panier = $_SESSION['panier'] ?? [];
$total = 0;
foreach ($panier as $item) {
  $total += $item['prix'] * $item['quantite'];
}

// === Gestion des infos client ===
$nom = htmlspecialchars($_POST['nom'] ?? '');
$adresse = htmlspecialchars($_POST['adresse'] ?? '');
$ville = htmlspecialchars($_POST['ville'] ?? '');
$cp = htmlspecialchars($_POST['code_postal'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');

// === Gestion du code promo ===
$reduction = 0;
$code_promo = $_SESSION['code_promo_applique'] ?? null;

if ($code_promo) {
  $codes_promo = [
    'FLOW10' => 0.10,
    'BONUS5' => 0.05
  ];

  $code = strtoupper(trim($code_promo));
  if (isset($codes_promo[$code])) {
    $reduction = $codes_promo[$code];
  }
}

$total_remise = $total * $reduction;
$total_apres_remise = $total - $total_remise;

// On vide le panier et le code promo après la commande
$_SESSION['panier'] = [];
unset($_SESSION['code_promo_applique']);
unset($_SESSION['reduction']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Commande Confirmée</title>
  <link rel="stylesheet" href="assets/style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #FFE0D4;
      margin: 0;
    }

    main {
      max-width: 700px;
      margin: 50px auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    h1 {
      text-align: center;
      color: #2e7d32;
    }

    h2 {
      margin-top: 30px;
      color: #444;
    }

    p {
      line-height: 1.6;
    }

    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: #FFFFFF;
    }

    a {
      display: block;
      margin-top: 25px;
      text-align: center;
      text-decoration: none;
      color: white;
      background: #F9AAB4;
      padding: 12px;
      border-radius: 8px;
    }

    a:hover {
      background: #5B4138;
    }
  </style>
</head>
<body>

<main>
  <h1>🎉 Merci pour votre commande !</h1>

  <h2>📦 Livraison à :</h2>
  <p>
    <?= $nom ?><br>
    <?= $adresse ?><br>
    <?= $cp . ' ' . $ville ?><br>
    📧 <strong><?= $email ?></strong>
  </p>

  <h2>🧾 Récapitulatif de la commande</h2>
  <?php if (!empty($panier)): ?>
    <table>
      <tr>
        <th>Image</th>
        <th>Produit</th>
        <th>Prix</th>
        <th>Qté</th>
        <th>Total</th>
      </tr>
      <?php foreach ($panier as $item): ?>
        <tr>
          <td><img src="assets/images/<?= htmlspecialchars($item['image']) ?>" width="60"></td>
          <td><?= htmlspecialchars($item['nom']) ?></td>
          <td><?= number_format($item['prix'], 2) ?> €</td>
          <td><?= $item['quantite'] ?></td>
          <td><?= number_format($item['prix'] * $item['quantite'], 2) ?> €</td>
        </tr>
      <?php endforeach; ?>

      <?php if ($reduction > 0): ?>
        <tr>
          <td colspan="4" align="right">Code promo (<?= htmlspecialchars($code_promo) ?>) :</td>
          <td>-<?= number_format($total_remise, 2) ?> €</td>
        </tr>
        <tr>
          <td colspan="4" align="right"><strong>Total après réduction :</strong></td>
          <td><strong><?= number_format($total_apres_remise, 2) ?> €</strong></td>
        </tr>
      <?php else: ?>
        <tr>
          <td colspan="4" align="right"><strong>Total :</strong></td>
          <td><strong><?= number_format($total, 2) ?> €</strong></td>
        </tr>
      <?php endif; ?>
    </table>
  <?php else: ?>
    <p>Votre panier était vide.</p>
  <?php endif; ?>

  <a href="index.php">🏠 Retour à l'accueil</a>
</main>

</body>
</html>
