<?php
session_start();

echo '<pre>';
print_r($_SESSION['panier']);
echo '</pre>';

$panier = $_SESSION['panier'] ?? [];

// Calcul du total
$total = 0;
foreach ($panier as $article) {
    if (is_array($article) && isset($article['prix'], $article['quantite'])) {
        $total += floatval($article['prix']) * intval($article['quantite']);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Votre panier</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="panier-container">
  <h2>Votre panier</h2>

  <?php if (empty($panier)): ?>
    <p class="panier-vide">Votre panier est vide.</p>
  <?php else: ?>
    <div class="panier-items">
      <?php foreach ($panier as $index => $article): ?>
        <?php
          // Sécurité : ignorer tout élément non valide
          if (!is_array($article) || !isset($article['nom'], $article['prix'], $article['quantite'], $article['image'])) {
              continue;
          }

          $nom = htmlspecialchars($article['nom']);
          $image = htmlspecialchars($article['image']);
          $quantite = intval($article['quantite']);
          $prix = floatval($article['prix']);
          $sous_total = $quantite * $prix;
        ?>
        <div class="panier-item">
          <img src="<?= $image ?>" alt="<?= $nom ?>">
          <div class="infos">
            <h3><?= $nom ?></h3>
            <p>Quantité : <?= $quantite ?></p>
            <p>Prix unitaire : <?= number_format($prix, 2) ?> €</p>
            <p class="sous-total">Sous-total : <?= number_format($sous_total, 2) ?> €</p>

            <div class="quantite-controls">
              <!-- Bouton - -->
              <form method="post" action="modifier_panier.php">
                <input type="hidden" name="action" value="decrease">
                <input type="hidden" name="index" value="<?= $index ?>">
                <button class="btn" type="submit">➖</button>
              </form>

              <!-- Bouton + -->
              <form method="post" action="modifier_panier.php">
                <input type="hidden" name="action" value="increase">
                <input type="hidden" name="index" value="<?= $index ?>">
                <button class="btn" type="submit">➕</button>
              </form>

              <!-- Bouton supprimer -->
              <form method="post" action="modifier_panier.php" onsubmit="return confirm('Supprimer ce produit ?')">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="index" value="<?= $index ?>">
                <button class="btn" type="submit">🗑️</button>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="total-section">
      <h3>Total : <?= number_format($total, 2) ?> €</h3>
      <a href="commande.php" class="btn-valider">Valider la commande</a>
    </div>
  <?php endif; ?>
</div>

</body>
</html>
