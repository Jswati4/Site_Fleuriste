<?php
session_start();

$panier = $_SESSION['panier'] ?? [];
$total = 0;
$reduction = 0;
$code_promo_applique = false;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon Panier</title>
  <link rel="stylesheet" href="assets/style.css">
  <style>
    .bouton-icone {
      background: none;
      border: none;
      font-size: 1.2em;
      cursor: pointer;
      margin: 0 5px;
    }
    .bouton-icone:hover {
      color: darkred;
    }
    table {
      border-collapse: collapse;
      width: 90%;
      margin: auto;
    }
    th, td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid #ccc;
    }
  </style>
</head>
<body>

<header>
  <h1>🧺 Mon Panier</h1>
</header>

<main>
  <?php if (empty($panier)): ?>
    <p style="text-align:center;">Votre panier est vide.</p>
    <div style="text-align:center;">
      <a href="boutique.php">← Retour à la boutique</a>
    </div>
  <?php else: ?>
    <table>
      <tr>
        <th>Image</th>
        <th>Nom</th>
        <th>Prix</th>
        <th>Quantité</th>
        <th>Total</th>
      </tr>

      <?php foreach ($panier as $item): ?>
        <?php
          $sous_total = $item['prix'] * $item['quantite'];
          $total += $sous_total;

          // Juste après le calcul du total, AVANT d'appliquer la réduction :
if (isset($_SESSION['reduction'])) {
    $reduction = $total * ($_SESSION['reduction'] / 100);
    $code_promo_applique = true;
}

      
        ?>
        <tr>
          <td><img src="assets/images/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['nom']) ?>" width="80"></td>
          <td><?= htmlspecialchars($item['nom']) ?></td>
          <td><?= number_format($item['prix'], 2) ?> €</td>
          <td>
            <form method="post" action="modifier_quantite.php" style="display:inline;">
              <input type="hidden" name="action" value="moins">
              <input type="hidden" name="nom" value="<?= htmlspecialchars($item['nom']) ?>">
              <button type="submit" class="bouton-icone">➖</button>
            </form>

            <?= htmlspecialchars($item['quantite']) ?>

            <form method="post" action="modifier_quantite.php" style="display:inline;">
              <input type="hidden" name="action" value="plus">
              <input type="hidden" name="nom" value="<?= htmlspecialchars($item['nom']) ?>">
              <button type="submit" class="bouton-icone">➕</button>
            </form>

            <form method="post" action="modifier_quantite.php" style="display:inline;">
              <input type="hidden" name="action" value="supprimer">
              <input type="hidden" name="nom" value="<?= htmlspecialchars($item['nom']) ?>">
              <button type="submit" class="bouton-icone">🗑️</button>
            </form>
          </td>
          <td><?= number_format($sous_total, 2) ?> €</td>
        </tr>
      <?php endforeach; ?>

      <?php
        if (isset($_SESSION['reduction'])) {
          $reduction = $total * ($_SESSION['reduction'] / 100);
          $code_promo_applique = true;
        }
        $total_final = $total - $reduction;
      ?>

      <?php if ($code_promo_applique): ?>
        <tr>
          <td colspan="4" align="right">Réduction (<?= htmlspecialchars($_SESSION['code_promo_applique']) ?>) :</td>
          <td>-<?= number_format($reduction, 2) ?> €</td>
        </tr>
      <?php endif; ?>

      <tr>
        <td colspan="4" align="right"><strong>Total à payer :</strong></td>
        <td><strong><?= number_format($total_final, 2) ?> €</strong></td>
      </tr>
    </table>

    <div style="text-align:center; margin-top: 20px;">
      <form method="post" action="appliquer_promo.php" style="display:inline-block;">
        <input type="text" name="code_promo" placeholder="Code promo" required>
        <button type="submit">Appliquer</button>
      </form>
    </div>

    

    <?php if (isset($_SESSION['promo_message'])): ?>
      <p style="text-align:center; color: darkred;"><?= htmlspecialchars($_SESSION['promo_message']) ?></p>
      <?php unset($_SESSION['promo_message']); ?>
    <?php endif; ?>

    <div style="text-align:center; margin-top: 30px;">
      <a href="boutique.php">← Continuer mes achats</a> |
      <a href="checkout.php"><button type="button">✅ Valider ma commande</button></a>
    </div>
  <?php endif; ?>
</main>

</body>
</html>
